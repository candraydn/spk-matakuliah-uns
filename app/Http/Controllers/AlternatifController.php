<?php

namespace App\Http\Controllers;

use App\model\Alternatif;
use App\model\Kriteria;
use App\model\Promethee;
use App\model\PvKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class AlternatifController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alternatif.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alterData = Alternatif::findorfail($id);
        return view('alternatif.edit', compact(['alterData']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($alterID)
    {
        request()->validate([
            'matkul'=>'required'
        ]);

        $alter = Alternatif::findorfail($alterID);
        $alter->nama_matakuliah = request()->matkul;
        $alter->semester_matakuliah = request()->semester;
        $alter->dosen_matakuliah = request()->dosen;
        $alter->save();

        session()->flash('updated', 'Sukses update data');
        return redirect('/alternatif');
    }

    public function bobot(Request $request)
    {
        if(isset($request->pilihsemester)){
            $alter = Alternatif::where('semester_matakuliah',$request->pilihsemester)->get();
            $krit = Kriteria::get();
            $semester = $request->pilihsemester;
            return view('alternatif.bobot2', compact(['alter','krit','semester']));
        }else{
            $alter = Alternatif::get();
            $krit = Kriteria::get();
            return view('alternatif.bobot', compact(['alter','krit']));
        }
    }

    public function postbobot(Request $request)
    {
        $semester = $request->semester;
        $id_user = Auth::user()->id;
        $alter = Alternatif::where('semester_matakuliah', $semester)->get();
        $krit = Kriteria::get();
        Promethee::where('semester',$semester)->where('id_user',$id_user)->delete();
        // dd($request->nilai11);   
        foreach($krit as $k)
        {
            foreach($alter as $a)
            {
                $var = "nilai".$k['id']."".$a['id'];
                $inputalter = new Promethee();
                $inputalter->id_kriteria = $k['id'];
                $inputalter->id_alternatif = $a['id'];
                $inputalter->step = '1';
                $inputalter->semester = $semester;
                $inputalter->id_user = $id_user;
                $inputalter->nilai = $request->$var;
                $inputalter->save();
            }
        }

        foreach($krit as $k)
        {
            foreach($alter as $a)
            {
                $kid = $k['id'];
                $aid = $a['id'];
                $min = Promethee::where('step',1)
                        ->where('id_kriteria',$kid)
                        ->where('semester',$semester)
                        ->where('id_user', $id_user)
                        ->min('nilai');
                $max = Promethee::where('step',1)
                        ->where('id_kriteria',$kid)
                        ->where('semester',$semester)
                        ->where('id_user', $id_user)
                        ->max('nilai');
                $nilai = Promethee::where('step',1)
                ->where('id_kriteria',$kid)
                ->where('id_alternatif',$aid)
                ->where('semester',$semester)
                ->where('id_user', $id_user)
                ->first();
                $nilai = $nilai['nilai'];
                $pembagi = $max-$min;
                if($pembagi == 0){
                    $nilaiAkhir = 0;
                }else{
                    $nilaiAkhir = ($nilai-$min)/($max-$min);
                }
                //input to table
                $step2 = new Promethee();
                $step2->id_kriteria = $k['id'];
                $step2->id_alternatif = $a['id'];
                $step2->step = '2';
                $step2->semester = $semester;
                $step2->id_user = $id_user;
                $step2->nilai = $nilaiAkhir;
                $step2->save();
            }
        }
        
        foreach($alter as $a)
        {
            foreach($alter as $b)
            {
                if($a != $b){
                    foreach($krit as $k)
                    {
                        $kid = $k['id'];
                        $aid = $a['id'];
                        $bid = $b['id'];
                        $nilai_a = Promethee::where('step','2')->where('id_kriteria',$kid)->where('semester',$semester)->where('id_user', $id_user)->where('id_alternatif',$aid)->first();
                        $nilai_b = Promethee::where('step','2')->where('id_kriteria',$kid)->where('semester',$semester)->where('id_user', $id_user)->where('id_alternatif',$bid)->first();
                        $hasil = $nilai_a['nilai'] - $nilai_b['nilai'];
                        //input to table
                        $step3 = new Promethee();
                        $step3->id_kriteria = $k['id'];
                        $step3->id_alternatif = $a['id'];
                        $step3->id_alternatif2 = $b['id'];
                        $step3->step = '3';
                        $step3->semester = $semester;
                        $step3->id_user = $id_user;
                        $step3->nilai = $hasil;
                        $step3->save();
                    }
                }
            }
        }

        foreach($alter as $a)
        {
            foreach($alter as $b)
            {
                if($a != $b){
                    foreach($krit as $k)
                    {
                        $kid = $k['id'];
                        $aid = $a['id'];
                        $bid = $b['id'];
                        $nilai_a = Promethee::where('step','3')->where('id_kriteria',$kid)->where('semester',$semester)->where('id_user', $id_user)->where('id_alternatif',$aid)->where('id_alternatif2',$bid)->first();
                        if($nilai_a['nilai']<=0){
                            $hasil = 0;
                        }else{
                            $hasil = 1;
                        }
                        //input to table
                        $step4 = new Promethee();
                        $step4->id_kriteria = $k['id'];
                        $step4->id_alternatif = $a['id'];
                        $step4->id_alternatif2 = $b['id'];
                        $step4->step = '4';
                        $step4->semester = $semester;
                        $step4->id_user = $id_user;
                        $step4->nilai = $hasil;
                        $step4->save();
                    }
                }
            }
        }

        foreach($alter as $a)
        {
            foreach($alter as $b)
            {
                if($a != $b){
                    foreach($krit as $k)
                    {
                        $kid = $k['id'];
                        $aid = $a['id'];
                        $bid = $b['id'];
                        $nilai = Promethee::where('step','4')->where('id_kriteria',$kid)->where('semester',$semester)->where('id_user', $id_user)->where('id_alternatif',$aid)->where('id_alternatif2',$bid)->first();
                        $pv = PvKriteria::where('id_kriteria',$kid)->first();
                        $hasil = $nilai['nilai']*$pv['nilai'];
                        //input to table
                        $step5 = new Promethee();
                        $step5->id_kriteria = $k['id'];
                        $step5->id_alternatif = $a['id'];
                        $step5->id_alternatif2 = $b['id'];
                        $step5->step = '5';
                        $step5->semester = $semester;
                        $step5->id_user = $id_user;
                        $step5->nilai = $hasil;
                        $step5->save();
                    }
                }
            }
        }

        foreach($alter as $a)
        {
            foreach($alter as $b)
            {
                if($a['id'] != $b['id']){
                    $aid = $a['id'];
                    $bid = $b['id'];
                    $nilai = Promethee::where('step','5')->where('id_alternatif',$aid)->where('semester',$semester)->where('id_user', $id_user)->where('id_alternatif2',$bid)->sum('nilai');
                    //input to table
                    $step6 = new Promethee();
                    $step6->id_alternatif = $a['id'];
                    $step6->id_alternatif2 = $b['id'];
                    $step6->step = '6';
                    $step6->semester = $semester;
                    $step6->id_user = $id_user;
                    $step6->nilai = $nilai;
                    $step6->save();
                }else{
                     //input to table
                     $step6 = new Promethee();
                     $step6->id_alternatif = $a['id'];
                     $step6->id_alternatif2 = $b['id'];
                     $step6->step = '6';
                     $step6->semester = $semester;
                     $step6->id_user = $id_user;
                     $step6->nilai = Null;
                     $step6->save();
                }
            }
        }
        foreach($alter as $a)
        {
            $aid = $a['id'];
            $nilai_a = Promethee::where('step','6')->where('semester',$semester)->where('id_user', $id_user)->where('id_alternatif',$aid)->avg('nilai');
            $nilai_b = Promethee::where('step','6')->where('semester',$semester)->where('id_user', $id_user)->where('id_alternatif2',$aid)->avg('nilai');
            $ef[] = $nilai_b;
            $hasil = $nilai_a-$nilai_b;
            //input to table
            $step7 = new Promethee();
            $step7->id_alternatif = $a['id'];
            $step7->step = '7';
            $step7->semester = $semester;
            $step7->id_user = $id_user;
            $step7->nilai = $hasil;
            $step7->save();
        }
        $pro6 = Promethee::where('step','6')->where('semester',$semester)->where('id_user', $id_user)->orderBy('id_alternatif','ASC')->get();
        $pro7 = DB::table('promethee')
        ->leftJoin('alternatifs', 'id_alternatif', '=', 'alternatifs.id')
        ->where('promethee.step','=','7')
        ->where('promethee.semester','=',$semester)
        ->where('promethee.id_user','=',$id_user)
        ->orderBy('promethee.nilai','DESC')
        ->get();
        // $pro7 = Promethee::where('step','7')->orderBy('nilai','DESC')->get();
        return view('alternatif.hasil', compact(['pro6','alter','ef','pro7']));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

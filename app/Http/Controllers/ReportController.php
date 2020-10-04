<?php

namespace App\Http\Controllers;

use App\model\Alternatif;
use App\model\Kriteria;
use App\model\Promethee;
use App\model\PvKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class reportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(isset($request->pilihsemester))
        {
            $semester = $request->pilihsemester;
            $alter = Alternatif::where('semester_matakuliah', $semester)->get();
            $krit = Kriteria::get();
            $id_user = Auth::user()->id;
            $pro = Promethee::where('step','6')->where('semester',$semester)->where('id_user', $id_user)->count();
            if($pro < 1){
                return view('report.null');
            }else{
                foreach($alter as $a)
                {
                    $aid = $a['id'];
                    $nilai_a = Promethee::where('step','6')->where('semester',$semester)->where('id_user', $id_user)->where('id_alternatif',$aid)->avg('nilai');
                    $nilai_b = Promethee::where('step','6')->where('semester',$semester)->where('id_user', $id_user)->where('id_alternatif2',$aid)->avg('nilai');
                    $ef[] = $nilai_b;
                    $pro6 = Promethee::where('step','6')->where('semester',$semester)->where('id_user', $id_user)->orderBy('id_alternatif','ASC')->get();
                    $pro7 = DB::table('promethee')
                    ->leftJoin('alternatifs', 'id_alternatif', '=', 'alternatifs.id')
                    ->where('promethee.step','=','7')
                    ->where('promethee.semester','=',$semester)
                    ->where('promethee.id_user','=',$id_user)
                    ->orderBy('promethee.nilai','DESC')
                    ->get();
                }
                return view('alternatif.hasil', compact(['pro6','alter','ef','pro7']));
            }
        }else{
            return view('report.index');
        }
    }
}

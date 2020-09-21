<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Kriteria;
use App\model\PerbandinganKriteria;
use App\model\PvKriteria;
use App\model\Ir;

class KriteriaController extends Controller
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
        return view('kriteria.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $kriteria = Kriteria::findorfail($id);

        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Kriteria $kriteria)
    {
        request()->validate([
            'nama_kriteria'=>'required'
        ]);
        $kriteria->nama_kriteria = request()->nama_kriteria;
        $kriteria->save();
        return redirect('/kriteria');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bobot()
    {
        $n = Kriteria::count();
        $kriteria = Kriteria::get();
        return view('kriteria.bobot', compact('kriteria', 'n'));
    }

    public function postbobot(Request $request)
    {
        function inputDataPerbandinganKriteria($kriteria1, $kriteria2, $nilai)
        {
            // $kriteria1 += $kriteria1;
            $kriteriaId1 = Kriteria::orderBy('id','asc')
                                    ->offset($kriteria1)
                                    ->limit(1)
                                    ->get();
            $kriteriaId2 = Kriteria::orderBy('id','asc')
                                    ->offset($kriteria2)
                                    ->limit(1)
                                    ->get();
            $id1 = $kriteriaId1[0]['id'];
            $id2 = $kriteriaId2[0]['id'];

            $insertK = new PerbandinganKriteria();
            $insertK->kriteria1 = $id1;
            $insertK->kriteria2 = $id2;
            $insertK->nilai = $nilai;
            $insertK->save();
        }
        $truncate = PerbandinganKriteria::query()->truncate();
        $truncatePv = PvKriteria::query()->truncate();
        $n = Kriteria::count();
        $matrik = array();
        $urut 	= 0;

        for ($x=0; $x <= ($n-2) ; $x++) {
            for ($y=($x+1); $y <= ($n-1) ; $y++) {
                $urut++;
                $pilih	= $_POST[$urut];
                $boboturut = "bobot".$urut;
                $bobot 	= $_POST[$boboturut];
                if ($pilih == 1) {
                    $matrik[$x][$y] = $bobot;
                    $matrik[$y][$x] = 1 / $bobot;
                } else {
                    $matrik[$x][$y] = 1 / $bobot;
                    $matrik[$y][$x] = $bobot;
                }
                inputDataPerbandinganKriteria($x,$y,$matrik[$x][$y]);
            }
        }
        // diagonal --> bernilai 1
        for ($i = 0; $i <= ($n-1); $i++) {
            $matrik[$i][$i] = 1;
        }

        // inisialisasi jumlah tiap kolom dan baris kriteria
        $jmlmpb = array();
        $jmlmnk = array();
        for ($i=0; $i <= ($n-1); $i++) {
            $jmlmpb[$i] = 0;
            $jmlmnk[$i] = 0;
        }

        // menghitung jumlah pada kolom kriteria tabel perbandingan berpasangan
        for ($x=0; $x <= ($n-1) ; $x++) {
            for ($y=0; $y <= ($n-1) ; $y++) {
                $value		= $matrik[$x][$y];
                $jmlmpb[$y] += $value;
            }
        }


        // menghitung jumlah pada baris kriteria tabel nilai kriteria
        // matrikb merupakan matrik yang telah dinormalisasi
        for ($x=0; $x <= ($n-1) ; $x++) {
            for ($y=0; $y <= ($n-1) ; $y++) {
                $matrikb[$x][$y] = $matrik[$x][$y] / $jmlmpb[$y];
                $value	= $matrikb[$x][$y];
                $jmlmnk[$x] += $value;
            }

            // nilai priority vektor
            $pv[$x]	 = $jmlmnk[$x] / $n;

            // memasukkan nilai priority vektor ke dalam tabel pv_kriteria dan pv_alternatif
                // $id_kriteria = getKriteriaID($x);
                // inputKriteriaPV($id_kriteria,$pv[$x]);
                $id_kriteria = Kriteria::orderBy('id','asc')
                                    ->offset($x)
                                    ->limit(1)
                                    ->get();
                $id_kriteria = $id_kriteria[0]['id'];
                $inputPv = new PvKriteria();
                $inputPv->id_kriteria = $id_kriteria;
                $inputPv->nilai = $pv[$x];
                $inputPv->save();
        }

        // cek konsistensi
        $eigenvektor = $this->getEigenVector($jmlmpb,$jmlmnk,$n);
        $consIndex   = $this->getConsIndex($jmlmpb,$jmlmnk,$n);
        $consRatio   = $this->getConsRatio($jmlmpb,$jmlmnk,$n);

        // nama kriteria
        $kriteria = Kriteria::orderBy('id','ASC')->get();
        $n = Kriteria::count();

        return view('kriteria.output', compact('consratio','kriteria','matrik','n','jmlmpb','matrikb','jmlmnk','pv','eigenvektor','consIndex','consRatio'));
    }

    public function getEigenVector($matrik_a,$matrik_b,$n) {
        $eigenvektor = 0;
        for ($i=0; $i <= ($n-1) ; $i++) {
            $eigenvektor += ($matrik_a[$i] * (($matrik_b[$i]) / $n));
        }
    
        return $eigenvektor;
    }
    
    // mencari Cons Index
    public function getConsIndex($matrik_a,$matrik_b,$n) {
        $eigenvektor = $this->getEigenVector($matrik_a,$matrik_b,$n);
        $consindex = ($eigenvektor - $n)/($n-1);
    
        return $consindex;
    }
    
    // Mencari Consistency Ratio
    public function getConsRatio($matrik_a,$matrik_b,$n) {
        $consindex = $this->getConsIndex($matrik_a,$matrik_b,$n);
        $consratio = $consindex / $this->getNilaiIR($n);
    
        return $consratio;
    }

    public function getNilaiIR($jmlKriteria) {
        // $query  = "SELECT nilai FROM ir WHERE jumlah=$jmlKriteria";
        $query = Ir::where('jumlah','=',$jmlKriteria)->get();
        $nilaiIR = $query[0]['nilai'];
        return $nilaiIR;
    }
}

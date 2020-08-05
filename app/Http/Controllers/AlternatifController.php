<?php

namespace App\Http\Controllers;

use App\model\Alternatif;
use Illuminate\Http\Request;

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

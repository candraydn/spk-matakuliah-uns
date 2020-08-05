<?php

namespace App\Http\Livewire\Alternatif;

use App\model\Alternatif;
use Livewire\Component;

class Post extends Component
{
    public $dosen, $matkul, $semester;

    public function addAlternatif()
    {
        $addAlter = new Alternatif;
        $addAlter['nama_matakuliah'] = $this->matkul;
        $addAlter['semester_matakuliah'] = $this->semester;
        $addAlter['dosen_matakuliah'] = $this->dosen;
        $addAlter->save();

        $this->matkul = '';
        $this->semester = '';
        $this->dosen = '';

        session()->flash('message','Sukses menambah mata kuliah');
        $this->emit('alterAdded', $addAlter->id);
    }

    public function render()
    {
        return view('livewire.alternatif.post');
    }
}

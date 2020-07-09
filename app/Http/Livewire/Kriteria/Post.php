<?php

namespace App\Http\Livewire\Kriteria;

use Livewire\Component;
use App\model\Kriteria;

class Post extends Component
{
    public $nama_kriteria;

    public function addKriteria()
    {
        $createKriteria = new Kriteria;
        $createKriteria['nama_kriteria'] = $this->nama_kriteria;
        $createKriteria->save();

        $this->nama_kriteria = '';

        $this->emit('kriteriaAdded', $createKriteria->id);
    }
    public function render()
    {
        return view('livewire.kriteria.post');
    }
}

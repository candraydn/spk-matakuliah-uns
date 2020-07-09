<?php

namespace App\Http\Livewire\Kriteria;

use Livewire\Component;
use App\model\Kriteria;

class Index extends Component
{
    public $kriterias;
    public $no;
    public $kriteriaId;

    protected $listeners = ['kriteriaAdded'];

    public function kriteriaAdded($kriteriaId){}
    
    public function deleteKriteria($kriteriaDel)
    {
        $deleteItem = Kriteria::find($kriteriaDel);
        $deleteItem->delete();
    }
    public function render()
    {
        $this->no=1;
        $this->kriterias = Kriteria::latest()->get();
        return view('livewire.kriteria.index', compact(['kriterias', 'no']));
    }
}
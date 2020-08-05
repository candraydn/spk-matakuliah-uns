<?php

namespace App\Http\Livewire\Alternatif;

use Livewire\Component;
use App\model\Alternatif;

class Index extends Component
{
    public $alternatifs;
    public $no;
    public $alterId;

    protected $listeners = ['alterAdded'];

    public function alterAdded($alterId){}

    public function deleteAlter($alterId)
    {
        $deleteItem = Alternatif::find($alterId);
        $deleteItem->delete();

        session()->flash('message','Data berhasil dihapus');
    }
    public function render()
    {
        $this->no = 1;
        $this->alternatifs = Alternatif::latest()->get();
        return view('livewire.alternatif.index', compact(['alternatifs','no']));
    }
}

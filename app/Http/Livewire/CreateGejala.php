<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CreateGejala extends Component
{
    public  $create_modal_gejala = false,
            $kode_gejala,
            $keterangan;
    public function render()
    {
        return view('livewire.create-gejala');
    }

    public $rules = [
        'kode_gejala'       => 'required',
        'keterangan'        => 'required'
    ];

    public function resetField()
    {
        $this->kode_gejala = '';
        $this->keterangan = '';
    }

    public function openCreateModal()
    {
        $this->create_modal_gejala = true;
    }

    public function closeAddGejala()
    {
        $this->create_modal_gejala = false;
    }

    public function storeGejala()
    {
        dd('Testing add gejala..');
    }

}

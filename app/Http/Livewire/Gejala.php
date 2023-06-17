<?php

namespace App\Http\Livewire;

use App\Models\{
    Gejala as Gejalas,
    Kecanduan,
};
use Livewire\Component;

class Gejala extends Component
{

    public  $create_modal = false,
            $edit_modal = false,
            $detail_modal = false,
            $cari_gejala = false,
            $kode_gejala,
            $keterangan,
            $gejalas,
            $gejala,
            $id_gejala,
            $kecanduans;
    public function render()
    {
        $gejalas = Gejalas::with('kecanduan')->get();
        foreach ($gejalas as $item) {
           $id_kecanduan = $item->kecanduan->id;
        }

        $kecanduans = Kecanduan::with(['level'], function($query) use ($id_kecanduan) {
            $query->where('id', $id_kecanduan)->get();
        })->get();

        return view('livewire.gejala', [
            $this->gejalas = $gejalas,
            $this->kecanduans = $kecanduans,
        ]);
    }

    public function openModalCreate()
    {
        $this->create_modal = true;
    }

    public function closeCreateModal()
    {
        $this->create_modal = false;
    }

    public function resetField()
    {
        $this->kode_gejala = '';

        $this->keterangan = '';
    }

    public function createGejala()
    {
        $this->openModalCreate();

        $this->resetField();
    }

    public function storeGejala()
    {
        // $this->create
    }

    public function editGejala($id_gejala)
    {
        dd('halaman edit gejala');
    }
}

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
            $id_gejala;

    public $rules = [
        'kode_gejala'       => 'required',
        'keterangan'        => 'required'
    ];

    public function render()
    {
        return view('livewire.gejala', [
            $this->gejalas = Gejalas::with('KecanduanGejala')->get(),
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
       $this->validate([
            'kode_gejala'       => 'required|unique:gejalas|string|max:4|min:3',
            'keterangan'        => 'required'
       ],[
        'kode_gejala.unique'    => 'Kode Gejala Sudah digunakan..',
        'kode_gejala.required'  => 'Kode Gejala wajib di isi...',
        'kode_gejala.max'       => 'Karakter Kode gejala maksimal 4',
        'kode_gejala.min'       => 'Karakter Kode Gejala Minimal 3',
        'keterangan.required'   => 'Keterangan Wajib diisi..'
       ]);

    $gejala = Gejalas::create([
        'kode_gejala'       => $this->kode_gejala,
        'keterangan'        => $this->keterangan,
    ]);

    $gejala->save();

    $this->resetField();

    $this->closeCreateModal();


    }

    public function openEditModal()
    {
        $this->edit_modal = true;
    }

    public function closeEditModal()
    {
        $this->edit_modal = false;
    }


    public function editGejala($id_gejala)
    {
        $this->openEditModal();

        $gejala = Gejalas::find($id_gejala);

        $this->id_gejala = $gejala->id;

        $this->kode_gejala = $gejala->kode_gejala;

        $this->keterangan = $gejala->keterangan;

    }

    public function updateGejala($id_gejala)
    {
        $this->validate([
            'kode_gejala'               => 'required|unique:gejalas',
            'keterangan'                => 'required'
        ], [
            'kode_gejala.unique'        => 'Kode Gejala Sudah digunakan',
            'kode_gejala.required'       => 'Kode Gejala Wajib diisi...',
            'keterangan.required'        =>  'Keterangan Gejala Wajib disi..'
        ]);

        $gejala = Gejalas::find($id_gejala);

        $gejala->update([
            'kode_gejala'           => $this->kode_gejala,
            'keterangan'            => $this->keterangan,
        ]);

        $this->resetField();

        $this->closeEditModal();
    }

    public function openDetailModal()
    {
        $this->detail_modal = true;
    }

    public function closeDetailModal()
    {
        $this->detail_modal = false;
    }

    public function detailGejala($id_gejala)
    {
        $this->openDetailModal();

        dd('Halaman detail Gejala..');
    }
}

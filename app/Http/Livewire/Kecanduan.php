<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kecanduan as Kecanduans;
use App\Helpers\LevelKecanduan;

class Kecanduan extends Component
{

    public  $create_modal = false,
            $edit_modal = false,
            $show_modal = false,
            $cari_kecanduan = false,
            $kecanduans,
            $kecanduan,
            $id_kecanduan,
            $kode_kecanduan,
            $level,
            $deskripsi;

    protected $listeners = [
        'deleteKecanduan'
    ];

    public function render()
    {

        return view('livewire.kecanduan', [
            $this->kecanduans = Kecanduans::all(),

            // $this->level = LevelKecanduan::LevelKecandaun,
        ]);
    }

    public function opencreateModal()
    {
        $this->create_modal = true;
    }

    public function closeCreateModal()
    {
        $this->create_modal = false;
    }

    public function openShowModal()
    {
        $this->show_modal = false;
    }

    public function openEditModal()
    {
        $this->edit_modal = true;
    }

    public function editKecanduan($id_kecanduan)
    {
        $kecanduan = Kecanduans::find($id_kecanduan);

        $this->openEditModal();

        $this->id_kecanduan = $id_kecanduan;

        $this->kode_kecanduan = $kecanduan->kode_kecanduan;

        $this->level = $kecanduan->level;
        
        $this->deskripsi = $kecanduan->deskripsi;
    }

    public function updateKecanduan($id_kecanduan)
    {
        $kecanduan = Kecanduans::find($id_kecanduan);
       
        // dd($this->id_kecanduan);
        $kecanduan->update([

            'kode_kecanduan'    => $this->kode_kecanduan,

            'level'             => $this->level,

            'deskripsi'         => $this->deskripsi,
        ]);

        // dd('data kecanduan berhasil diupdate');
    }

    public function closeEditModal()
    {
        $this->edit_modal = false;
    }

    public function detailKecanduan()
    {
        // $this->openShowModal();
        dd('Halaman Detail Kecanduan');
    }

    public function deleteConfirmation($id_kecanduan)
    {
        dd('id_kecanduan', $id_kecanduan);
    }

    public function deleteKecanduan($id)
    {
        Kecanduans::where('id', $id);
    }

    protected $rules = [
        'kode_kecanduan'        => 'required|unique|string|max:4|min:3',
        'level'                 => 'required|string',
        'descripsi'             => 'required|string|max:50|min:3'
    ];

    public function resetField()
    {
        $this->kode_kecanduan = '';
        $this->level = '';
        $this->deskripsi = '';
    }

    public function storeKecanduan()
    {
        // dd('store kecanduan');
        $this->opencreateModal();

        $this->validate([
            'kode_kecanduan'            => 'required',
            'level'                     => 'required',
            'deskripsi'                 => 'required'
        ],[
            'kode_kecanduan.unique'     => 'Kode Kecanduan Harus unik',
            'kode_kecanduan.required'   => 'Kode Kecanduan Wajib diisi..',
            'level.required'            => 'level kecanduan harus karakter',
            'deskripsi.required'        => 'Keterangan Wajib diisi..'
        ]);

        $kecanduan = Kecanduans::create([
            'kode_kecanduan'            => $this->kode_kecanduan,
            'level'                     => $this->level,
            'deskripsi'                 => $this->deskripsi,
        ]);

        $this->resetField();

        $this->closeCreateModal();

        $kecanduan->save();

    }
}

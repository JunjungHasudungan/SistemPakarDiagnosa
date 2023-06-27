<?php

namespace App\Http\Livewire;

use App\Models\{
    Kecanduan,
    Level,
    Solusi as Solusis,
};

use App\Helpers\ForRole;
use Livewire\Component;

class Solusi extends Component
{
    public  $open_modal = false,
            $show_modal = false,
            $edit_modal = false,
            $cari_solusi = false,
            $id_solusi,
            $solutions,
            $keterangan;

    protected $rules = [
        'keterangan'        => 'required',

    ];

    public $listeners  = [
        'deleteSolusi'
    ];

    public function render()
    {
        return view('livewire.solusi', [
            $this->solutions  = Solusis::with('kecanduan')->get(),
        ]);
    }

    public function openModalCreate()
    {
        $this->open_modal = true;
    }

    public function closeModalCreate()
    {
        $this->open_modal = false;

        $this->resetValidation('keterangan');
    }

    public function createSolusi()
    {
        $this->openModalCreate();

        $this->resetField();

    }

    public function storeSolusi()
    {
        $this->validate([
            'keterangan'                => 'required',
        ],[
            'keterangan.required'       => 'Keterangan Solusi wajib diisi..'
        ]);

        $solusi = Solusis::create([
            'keterangan'                => $this->keterangan,
        ]);

        $solusi->save();

        $this->resetField();

        $this->closeModalCreate();

        $this->dispatchBrowserEvent('toastr:info', [
            'message'       => 'Data Berhasil ditambahkan..'
        ]);
    }

    public function openModalEdit()
    {
        $this->edit_modal = true;
    }

    public function editSolusi($id_solusi)
    {
        $this->openModalEdit();

        $solusi = Solusis::find($id_solusi);

        $this->id_solusi = $solusi->id;

        $this->keterangan = $solusi->keterangan;

    }

    public function updateSolusi($id_solusi)
    {
        $solusi = Solusis::find($id_solusi);

        $this->id_solusi = $solusi->id_solusi;

        $this->validate([
            'keterangan'            => 'required'
        ],[
            'keterangan.required'   => 'Solusi Keterangan Wajib diisi..'
        ]);
        // $solusi->keterangan;
        $solusi->update([
            'keterangan'        => $this->keterangan
        ]);

        $solusi->save();

        $this->resetField();

        $this->closeModalEdit();

        $this->dispatchBrowserEvent('toastr:info', [
            'message'       => 'Data Berhasil diupdate..'
        ]);
    }

    public function closeModalEdit()
    {
        $this->edit_modal = false;
    }

    public function openModalDetail()
    {
        $this->show_modal = true;
    }

    public function detailSolution($id_solusi)
    {
        dd('Halaman detail solusi');

        $this->id_solusi = $id_solusi;
    }

    public function closeModalDetail()
    {
        $this->show_modal = false;
    }

    public function resetField()
    {
        $this->keterangan = '';
    }

    public function deleteConfirmation($id)
    {
        $this->id_solusi = $id;

        $this->dispatchBrowserEvent('swal:confirm', [
            'type'  => 'warning',
            'title' => 'Yakin untuk menghapus?',
            'text'  => '',
            'id'    => $id
        ]);
    }

    public function deleteSolusi($id)
    {
        Solusis::where('id', $id)->delete();

        $this->dispatchBrowserEvent('solusiDeleted');
    }

}

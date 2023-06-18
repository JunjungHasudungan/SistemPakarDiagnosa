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
            $id_solution,
            $solutions,
            $keterangan;

    protected $rules = [
        'kecanduan_id'      => 'required',
        'to_role'           => 'required',
        'keterangan'        => 'required',
        'from_role'         => 'nullable'

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
    }

    public function createSolution()
    {
        $this->openModalCreate();

        $this->resetField();

    }

    public function storeSolution()
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
    }

    public function openModalEdit()
    {
        $this->edit_modal = true;
    }

    public function editSolusi($id_solusi)
    {
        $this->id_solution = $id_solusi;

        dd($this->id_solution);

    }

    public function closeModalEdit()
    {
        $this->edit_modal = false;
    }

    public function openModalDetail()
    {
        $this->show_modal = true;
    }

    public function detailSolution($id_solution)
    {
        dd('Halaman detail solusi');

        $this->id_solution = $id_solution;
    }

    public function closeModalDetail()
    {
        $this->show_modal = false;
    }

    public function resetField()
    {
        $this->keterangan = '';
    }

    public function deleteConfirmation($id_solution)
    {
        $this->id_solution = $id_solution;
    }

}

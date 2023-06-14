<?php

namespace App\Http\Livewire;

use App\Models\Solution;
use Livewire\Component;

class Solusi extends Component
{
    public  $open_modal = false,
            $show_modal = false,
            $edit_modal = false,
            $id_solution,
            $description,
            $solutions;
    public function render()
    {
        return view('livewire.solusi', [
            $this->solutions  = Solution::with('kecanduan')->get()
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
        dd('Halaman create solution');
    }

    public function openModalEdit()
    {
        $this->edit_modal = true;
    }

    public function editSolution($id_solution)
    {
        $this->id_solution = $id_solution;

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
        $this->description = '';
    }

    public function deleteConfirmation($id_solution)
    {
        $this->id_solution = $id_solution;
    }
}

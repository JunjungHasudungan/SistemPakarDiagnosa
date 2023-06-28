<?php

namespace App\Http\Livewire;

use App\Models\Gejala;
use Livewire\Component;

class Diagnosa extends Component
{
    public  $create_modal = false,
            $gejala,
            $user_id;

    public $all_gejala = [];

    public function mount()
    {
        $this->all_gejala = Gejala::all();
    }
    public function render()
    {
        // dd($this->all_gejala);

        return view('livewire.diagnosa');
    }

    public function openCreateModal()
    {
        $this->create_modal = true;
    }

    public function createDiagnosa()
    {
        $this->openCreateModal();

    }

    public function storeDiagnosa()
    {
        $this->openCreateModal();
    }

    public function closeCreateModal()
    {
        $this->create_modal = false;
    }
}

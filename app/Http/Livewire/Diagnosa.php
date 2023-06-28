<?php

namespace App\Http\Livewire;

use App\Models\Gejala;
use App\Helpers\AnswerDiagnosa;
use Livewire\Component;

class Diagnosa extends Component
{
    public  $create_modal = false,
            $gejala,
            $answer_diagnosa,
            $user_id;

    public $all_gejala = [];
    public $all_answer = [];

    public function mount()
    {
        $this->all_gejala = Gejala::all();

        $this->all_answer = Gejala::all();
    }
    public function render()
    {
        // dd($this->all_gejala);

        return view('livewire.diagnosa', [
            $this->answer_diagnosa = AnswerDiagnosa::AnswerDiagnosa,
        ]);
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

        dd($this->gejala);
    }

    public function closeCreateModal()
    {
        $this->create_modal = false;
    }
}

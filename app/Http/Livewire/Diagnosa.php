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
            $say_no = 0,
            $user_id;

    public $gejalas = [];
    public $diagnosa_gejala = [];
    public $gejala_diagnonsa = [];

    public function mount()
    {
        $this->gejalas = Gejala::all();

        $this->diagnosa_gejala = [
            [
                'gejala_id'     => ''
            ]
        ];

        $this->gejala_diagnonsa = [

        ];

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

    public function addGejalaDiagnosa()
    {
        $this->diagnosa_gejala = [
            'gejala_id'     => ''
        ];
    }

    public function storeDiagnosa()
    {
        $this->openCreateModal();

        dd($this->diagnosa_gejala);
    }

    public function closeCreateModal()
    {
        $this->create_modal = false;
    }
}

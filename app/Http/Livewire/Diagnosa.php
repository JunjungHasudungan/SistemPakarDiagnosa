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

    public $gejalas = [];
    public $diagnosa_gejala = [];

    public function mount()
    {
        $this->gejalas = Gejala::all();

        $this->diagnosa_gejala = [
            [
                'gejala_id'     => ''
            ]
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

    public function storeDiagnosa()
    {
        $this->openCreateModal();

        foreach ($this->diagnosa_gejala as $gejala) {
          dd($gejala);
        }
    }

    public function closeCreateModal()
    {
        $this->create_modal = false;
    }
}

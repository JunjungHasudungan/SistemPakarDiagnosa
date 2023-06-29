<?php

namespace App\Http\Livewire;

use App\Models\{
    Gejala,
    Kecanduan
};
use App\Helpers\AnswerDiagnosa;
use Illuminate\Support\Facades\DB;
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
    }
    public function render()
    {
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
        $this->user_id = DB::table('temp_gejala')->get();

        // dd($this->user_id);

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

        $this->validate([
            'gejala'        => 'required|min:2'
        ], [
            'gejala.required'   => 'Gejala wajib dipilih..',
            'gejala.min'        => 'Gejala yang dipilih min 2..'
        ]);


        $kecanduan = Kecanduan::orderBy('id', 'asc')->get();
        $count_gejala_kecanduan = DB::table('gejala_kecanduan')->groupBy('kecanduan_id')->get(['kecanduan_id'])->count();
        $count_permasalahan = $kecanduan->count();
        if($count_gejala_kecanduan != $count_permasalahan){
            dd('sistem sedang bermasalah..');
        }else{
            dd($count_permasalahan);
        }
        // dd('testing store gejala diagnosa..');

    }

    public function closeCreateModal()
    {
        $this->create_modal = false;

        $this->resetValidation(['gejala']);
    }
}

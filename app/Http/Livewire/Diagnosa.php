<?php

namespace App\Http\Livewire;

use App\Models\{
    Gejala,
    Kecanduan
};
use App\Helpers\AnswerDiagnosa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Diagnosa extends Component
{
    public  $create_modal = false,
            $gejala,
            $user_id;

    public $gejalas = [];
    public $select_gejala = [];

    public function mount()
    {
        $this->gejalas = Gejala::all();

        $this->user_id = auth()->user()->id;

        $this->select_gejala = collect();
    }
    public function render()
    {
        return view('livewire.diagnosa');
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

    public function storeDiagnosa(Request $request)
    {
        $this->openCreateModal();

        $this->validate([
            'select_gejala'             => 'required|min:2'
        ], [
            'select_gejala.required'   => 'Gejala wajib dipilih..',
            'select_gejala.min'        => 'Gejala yang dipilih min 2..'
        ]);



        $kecanduan = Kecanduan::orderBy('id', 'asc')->get();
        $count_gejala_kecanduan = DB::table('gejala_kecanduan')->groupBy('kecanduan_id')->get(['kecanduan_id'])->count();
        $count_kecanduan = $kecanduan->count();

        $jumlah_select = count($this->select_gejala);

        if($jumlah_select > 2){
            $this->resetValidation(['select_gejala']);
        }

        if($count_kecanduan != $count_gejala_kecanduan){
            dd('data relasi tidak sama');
        }
        dd($jumlah_select);
    }

    public function closeCreateModal()
    {
        $this->create_modal = false;

        $this->resetValidation(['select_gejala']);
        $this->select_gejala = [];
    }
}

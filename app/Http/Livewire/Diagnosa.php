<?php

namespace App\Http\Livewire;

use App\Models\{
    Gejala,
    Kecanduan,
    TempDiagnosa
};
use App\Helpers\AnswerDiagnosa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Diagnosa extends Component
{
    public  $create_modal = false,
            $gejala,
            $kecanduan_id,
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

        $this->user_id = auth()->user()->id;

        $kecanduan = Kecanduan::orderBy('id', 'asc')->get();

        foreach ($kecanduan as $item) {
            $this->kecanduan_id = $item->id;
        }

        $count_gejala_kecanduan = DB::table('gejala_kecanduan')->groupBy('kecanduan_id')->get(['kecanduan_id'])->count();

        $count_kecanduan = $kecanduan->count();

        $jumlah_select = count($this->select_gejala);

        // dd($count_kecanduan);
        if($count_kecanduan != $count_gejala_kecanduan){
            dd('data relasi tidak sama');
        }
        // mengambil data dari select_gejala dan melakukan foreach
        foreach ($this->select_gejala as $gejala) {

           $gejala = Gejala::with(['kecanduanGejala'], function($query){

                $query->where('kecanduan_id', $this->kecanduan_id)->get();

           })->find($gejala);

          foreach ($gejala->kecanduanGejala as $kecanduan) {
           dd($kecanduan->id);
          }

        }

        // dd('data diagnosa berhasil disimpan..');

        // $this->closeCreateModal();
    }

    public function showResultDiagnosa()
    {

    }

    public function closeCreateModal()
    {
        $this->create_modal = false;

        $this->resetValidation(['select_gejala']);
        $this->select_gejala = [];
    }
}

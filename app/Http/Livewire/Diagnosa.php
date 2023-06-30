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
        $count_gejala_kecanduan = DB::table('gejala_kecanduan')->groupBy('kecanduan_id')->get(['kecanduan_id'])->count();
        $count_kecanduan = $kecanduan->count();

        $jumlah_select = count($this->select_gejala);

        if($count_kecanduan != $count_gejala_kecanduan){
            dd('data relasi tidak sama');
        }
        foreach ($this->select_gejala as $gejala_id) {
                $gejala = Gejala::with('KecanduanGejala')->find($gejala_id);

            foreach ($gejala->KecanduanGejala as $kecanduan) {
                $temp_diagnosa = TempDiagnosa::where('user_id', $this->user_id)->where('kecanduan_id', $kecanduan->id);
                $temp_diag = $temp_diagnosa->first();
                if (!$temp_diag) {
                    $temp_diag = new TempDiagnosa();
                    $temp_diag->user_id = $this->user_id;
                    $temp_diag->kecanduan_id = $kecanduan->id;
                    $temp_diag->gejala = $gejala->id;
                    $temp_diag->gejala_terpenuhi = 1;
                    $temp_diag->save();
                }else{
                    $temp_diag = $temp_diagnosa->update(['gejala_terpenuhi' => $temp_diag->gejala_terpenuhi + 1 ]);
                }
            }
        }
        // dd('data berhasil disimpan');
        //
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

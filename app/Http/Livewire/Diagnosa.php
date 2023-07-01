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
            $id_gejala,
            $kecanduan_id,
            $user_id;

    public $gejalas = [];
    public $select_gejala = [];

    public $listeners = [
        'showEmptyGejala'
    ];

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
        $this->user_id = DB::table('temp_gejala')->get();

        if (count($this->gejalas) > 0) {

                $this->openCreateModal();

        } else {

          $this->showEmptyGejala();

        }

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

        // dd($count_kecanduan);
        if($count_kecanduan != $count_gejala_kecanduan){
            dd('data relasi tidak sama');
        }

        // mengambil data dari select_gejala dan melakukan foreach
        foreach ($this->select_gejala as $gejala_id) {

            $this->id_gejala = $gejala_id;

            $this->gejalas = Gejala::with(['kecanduanGejala'], function($query){

                $query->where('kecanduan_id', $this->kecanduan_id)->get();

           })->find($this->id_gejala);

            $temp_diagnosa = new TempDiagnosa();

        foreach ($this->gejalas->kecanduanGejala as $kecanduan) {

            $temp_diagnosa = TempDiagnosa::create([
                    'kecanduan_id'      => $kecanduan->id,
                    'user_id'           => $this->user_id,
                    'gejala'            => $this->id_gejala,
                    'gejala_terpenuhi'  => 1,
            ]);
          }
        }
        $temp_diagnosa->save();

        $this->closeCreateModal();

        $this->dispatchBrowserEvent( 'toastr:info', [
            'message'   => 'Berhasil Melakukan diagnosa..'
        ]);
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

    public function showEmptyGejala()
    {
        $this->dispatchBrowserEvent('alert', [
            'type'      => 'error',
            'message'   => 'Pertanyaan Diagnosa Belum Tersedia..'
        ]);
    }
}

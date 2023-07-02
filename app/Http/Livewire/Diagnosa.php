<?php

namespace App\Http\Livewire;

use App\Models\{
    Diagnosa as Diagnosas,
    DiagnosaKecanduan,
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
            $id_diagnosa,
            $id_kecanduan,
            $kecanduans,
            $kecanduan,
            $created_at,
            $index,
            $user_id;

    public $gejalas = [];
    public $select_gejala = [];

    public $listeners = [
        'showEmptyGejala',
        'showErrorSistemGejala'
    ];

    public function mount()
    {
        // $this->gejalas = Gejala::all();

        $this->user_id = auth()->user()->id;

        $this->select_gejala = collect();
    }
    public function render()
    {
        // mengambil data diagnosa berdasarkan waktu pembuatan

        return view('livewire.diagnosa', [
            $this->gejalas   = Gejala::with('kecanduanGejala')->get()
        ]);
    }

    public function openCreateModal()
    {
        $this->create_modal = true;
    }

    public function createDiagnosa()
    {
        // $this->user_id = DB::table('temp_gejala')->get();

        $this->gejala = Gejala::orderBy('id', 'asc')->get();

            $this->id_diagnosa = DB::table('diagnosas')->get();

        $count_gejala = count($this->gejala);

        // dd($count_gejala);

        if ( $count_gejala > 0 ) {

                $this->openCreateModal();

        } else {

          $this->showEmptyGejala();

        }

    }

    public function storeDiagnosa(Request $request)
    {
        // mengambil data kecanduan order id
        $kecanduan = Kecanduan::orderBy('id', 'asc')->get();

        foreach ($kecanduan as $item) {
            $this->kecanduan_id = $item->id;
        }

        $count_gejala_kecanduan = DB::table('gejala_kecanduan')->groupBy('kecanduan_id')->get(['kecanduan_id'])->count();

        $count_kecanduan = $kecanduan->count();


        if($count_kecanduan != $count_gejala_kecanduan){

           $this->showErrorSistemGejala();

           $this->closeCreateModal();
        }else {

            $this->openCreateModal();

            $this->validate([
                'select_gejala'             => 'required|min:2'
            ], [
                'select_gejala.required'   => 'Gejala wajib dipilih..',
                'select_gejala.min'        => 'Gejala yang dipilih min 2..'
            ]);

            $this->user_id = auth()->user()->id;


            Kecanduan::with('gejalaKecanduan')->get();


            // mengambil data dari select_gejala dan melakukan foreach
            foreach ($this->select_gejala as $gejala_id) {

                $this->id_gejala = $gejala_id;
            }

            dd($this->id_gejala);





            // dd('diagnosa berhasil dilakukan..');

            $this->closeCreateModal();

            $this->dispatchBrowserEvent( 'toastr:info', [
                'message'   => 'Berhasil Melakukan diagnosa..'
            ]);
        }
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
        $this->dispatchBrowserEvent('swal:modal', [
            'type'      => 'error',
            'title'     => 'Maaf, Diagnosa Belum Tersedia..',
            'text'      => ''
        ]);
    }

    public function showErrorSistemGejala()
    {
        $this->dispatchBrowserEvent('swal:modal', [
            'type'      => 'error',
            'title'     => 'Maaf, Terjadi Kesalahan. Coba Beberapa saat lagi..',
            'text'      => ''
        ]);
    }
}

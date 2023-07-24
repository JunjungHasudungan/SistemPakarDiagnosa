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
            $solusi_kecanduan,
            $kecanduan,
            $antrian = 1,
            $user_id;

    public $gejalas = [];
    public $select_gejala = [];
    public $hasil_diagnosa = [];
    public $all_kecanduan = [];
    public $diagnosas = [];

    public $listeners = [
        'showEmptyGejala',
        'showErrorSistemGejala'
    ];

    public function mount()
    {
        $this->gejalas   = Gejala::with('kecanduanGejala')->get();

        $this->select_gejala = collect();

        $this->diagnosas = Diagnosas::where('user_id', 2)->get();
    }

    public function render()
    {

        $this->all_kecanduan = Kecanduan::with(['gejalaKecanduan', 'solusiKecanduan'])->get();

        $this->diagnosas = [];

        $this->diagnosas = Diagnosas::where('user_id', 2)->get();

        if (!$this->diagnosas) {
            return;
        }

        $this->diagnosas = Diagnosas::with(['user', 'kecanduan'], function($query){

            $query->where('role_id', 2)->get();

        })->where('user_id', auth()->id())->get();

        return view('livewire.diagnosa', [

            'diagnosas'    => $this->diagnosas,

        ]);
    }

    public function openCreateModal()
    {
        $this->create_modal = true;
    }

    public function createDiagnosa()
    {
        $all_gejala = Gejala::orderBy('id', 'asc')->get();

        $all_kecanduan = Kecanduan::orderBy('id', 'asc')->get();

        $jumlah_gejala = count($all_gejala);

        $jumlah_kecanduan = count($all_kecanduan);

        if ( ( $jumlah_gejala || $jumlah_kecanduan ) > 0 ) {

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

        // dd($count_gejala_kecanduan);
        $count_kecanduan = $kecanduan->count();
        // dd($count_kecanduan);

        if(( $count_kecanduan < 0 ) || ( $count_gejala_kecanduan < 0)){

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

            // mengambil data dari select_gejala dan melakukan foreach
            foreach ($this->select_gejala as $id_gejala) {

                    $gejala = Gejala::find($id_gejala);

                foreach ($gejala->kecanduanGejala as $kecanduan) {

                    $this->kecanduan_id = $kecanduan->id;

                    $this->kecanduan  = Kecanduan::where('id', $kecanduan->id)->get();

                }
            }

                foreach ($this->kecanduan as $item) {
                   $this->kecanduan_id = $item->id;

                   $diagnosa = Diagnosas::create([
                       'user_id'        => auth()->id(),
                       'kecanduan_id'   => $this->kecanduan_id,
                       'queue'          => $this->antrian++,
                       'status_diag'    => 1,
                   ]);

                   $diagnosa->save();
                }

            $this->closeCreateModal();

            $this->dispatchBrowserEvent( 'toastr:info', [
                'message'   => 'Berhasil Melakukan diagnosa..'
            ]);
        }
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


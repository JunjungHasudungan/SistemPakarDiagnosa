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
            $user_id;

    public $gejalas = [];
    public $select_gejala = [];
    public $hasil_diagnosa = [];

    public $listeners = [
        'showEmptyGejala',
        'showErrorSistemGejala'
    ];

    public function mount()
    {
        $this->user_id = auth()->user()->id;

        $this->gejalas   = Gejala::with('kecanduanGejala')->get();

        $this->select_gejala = collect();
    }

    public function render()
    {

        $this->hasil_diagnosa = TempDiagnosa::with('kecanduan')->where('user_id', $this->user_id)->get();

        if (!$this->hasil_diagnosa) {
           return;
        }

        foreach ($this->hasil_diagnosa as $diagnosa) {
            $diagnosa->kecanduan_id;
            $created_at = $diagnosa->created_at;
            $diagnosa_kecanduan = $diagnosa->kecanduan->solusiKecanduan;
        }

        return view('livewire.diagnosa', [
            'hasil_diagnosa'    => $this->hasil_diagnosa,
        ]);
    }

    public function openCreateModal()
    {
        $this->create_modal = true;
    }

    public function createDiagnosa()
    {
        $this->gejala = Gejala::orderBy('id', 'asc')->get();

        if ( count($this->gejala) > 0 ) {

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

            // mengambil data dari select_gejala dan melakukan foreach
            foreach ($this->select_gejala as $id_gejala) {

                    $gejala = Gejala::find($id_gejala);

                foreach ($gejala->kecanduanGejala as $kecanduan) {
                   $temp_diagnosa = TempDiagnosa::where('user_id', auth()->user()->id)->where('kecanduan_id', $kecanduan->id);
                    $jumlah_kecanduan = count($kecanduan->gejalaKecanduan);
                //    $temp_diag = $temp_diagnosa->first();
                    // if(!$temp_diag){
                         $temp_diagnosa = TempDiagnosa::create([
                            'user_id'                       => auth()->user()->id,
                            'kecanduan_id'                  => $kecanduan->id,
                            'jumlah_kecanduan'              => $jumlah_kecanduan,
                            'gejala_terpenuhi'              => 1,
                        ]);
                        $temp_diagnosa->save();
                    // }
                    // dd(count($kecanduan->gejalaKecanduan));
                }
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

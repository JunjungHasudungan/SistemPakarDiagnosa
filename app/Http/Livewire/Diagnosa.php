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
            $kecanduans,
            $kecanduan,
            $created_at,
            $user_id;

    public $gejalas = [];
    public $select_gejala = [];

    public $listeners = [
        'showEmptyGejala',
        'showErrorSistemGejala'
    ];

    public function mount()
    {
        $this->gejalas = Gejala::all();

        $this->user_id = auth()->user()->id;

        $this->select_gejala = collect();
    }
    public function render()
    {
        // mengambil data diagnosa berdasarkan waktu pembuatan
        $temp_diagnosa = TempDiagnosa::with('kecanduan')->where('user_id', auth()->user()->id)->get();

       if(count($temp_diagnosa) > 0){
           foreach ($temp_diagnosa as $key => $item) {
               $kecanduan_id = $item->kecanduan->id;
               $this->created_at = $item->created_at;
           }
       }

       $this->kecanduan = Kecanduan::with(['diagnosas:kecanduan_id'], function($query) use($kecanduan_id){
        $query->where('kecanduan_id', $kecanduan_id)->get();
       })->get();

        // dd($this->kecanduans);

        return view('livewire.diagnosa', [
            'diagnosa'          => $this->kecanduan,
            'created_at'        => $this->created_at,
        ]);
    }

    public function openCreateModal()
    {
        $this->create_modal = true;
    }

    public function createDiagnosa()
    {
        $this->user_id = DB::table('temp_gejala')->get();

        $this->gejala = Gejala::orderBy('id', 'asc')->get();

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

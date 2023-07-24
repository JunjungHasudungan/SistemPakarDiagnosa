<?php

namespace App\Http\Livewire;

use App\Models\{
    Kecanduan,
    Gejala,
    Solusi,
    Diagnosa,
    User,
};
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminDashboard extends Component
{
    public  $users,
            $all_kecanduan,
            $all_gejala,
            $id_user,
            $diag_user,
            $amount_diag,
            $all_solusi;

    public $hasil_diagnosa = [];
    public $all_diagnosa = [];

    public function mount()
    {
        // $this->all_diagnosa = [];
        $this->all_diagnosa = Diagnosa::with(['user'])->get();

        if(count($this->all_diagnosa) > 0){
            // dd('data hasil diagnosa ada..');

            $this->users = User::with(['diagnosa'], function($query){
                $query->where('status_diag', 1)->get();
            })->where('role_id', 2)->get();
        }else{
            $this->all_diagnosa = [];
        }


        // dd($this->all_diagnosa);

    }

    public function render()
    {
        return view('livewire.admin-dashboard', [
            $this->all_kecanduan    = Kecanduan::select('id')->get(),
            $this->all_gejala       = Gejala::select('id')->get(),
            $this->all_solusi       = Solusi::select('id')->get(),
            $this->users            = $this->users,
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\{
    Kecanduan,
    Gejala,
    Solusi,
    TempDiagnosa,
    User,
};
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AdminDashboard extends Component
{

    public  $id_kecanduan,
            $count_id_kecanduan,
            $users,
            $temp_diag,
            $id_user;

    public  $all_kecanduan = [];
    public  $all_gejala = [];
    public  $all_solusi = [];
    public  $hasil_diagnosa = [];

    public function mount()
    {
        $this->all_kecanduan = Kecanduan::with(['gejalaKecanduan', 'solusiKecanduan'])->get();
        $this->all_gejala = Gejala::with('kecanduanGejala')->get();
        $this->all_solusi = Solusi::all();

        $temp_diag = TempDiagnosa::with(['userDiagnosa'])->get();

       foreach ($temp_diag as $user) {
        $this->id_user = $user->user_id;
        $this->id_kecanduan = $user->kecanduan_id;
        // $this->count_id_kecanduan = count($user->kecanduan_id);

       }

       $this->users = User::with(['hasilDiagnosa'], function($query){
        $query->where('user_id', $this->id_user)->where('kecanduan_id', $this->id_kecanduan)->get();
       })->where('role_id', 2)->get();

    //    dd($this->users->)
    }
    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}

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

        $this->hasil_diagnosa = TempDiagnosa::with(['userDiagnosa'])->get();
        if (count($this->hasil_diagnosa) > 0) {
                foreach ($this->hasil_diagnosa as $user) {
                $this->id_user = $user->user_id;
                $this->id_kecanduan = $user->kecanduan_id;
            }
       }else {
        $this->hasil_diagnosa = [];
       }


    }
    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}

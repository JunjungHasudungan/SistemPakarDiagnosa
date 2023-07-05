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
            $user_name,
            $temp_diag,
            $diagnosa_user,
            $id_user;

    public  $all_kecanduan = [];
    public  $all_gejala = [];
    public  $all_solusi = [];
    public  $hasil_diagnosa = [];

    public function mount()
    {

        $this->hasil_diagnosa = TempDiagnosa::with(['userDiagnosa', 'diagnosaKecanduan'])->select('user_id')
                        ->groupBy('user_id')->get();


                        if (count($this->hasil_diagnosa) > 0) {
                            foreach ($this->hasil_diagnosa as $user_id) {
                               $this->id_user = $user_id;
                            }
                        }else {
                            $this->hasil_diagnosa = [];
                        }
                        // dd($this->id_user);

        $this->diagnosa_user =  TempDiagnosa::with(['userDiagnosa', 'diagnosaKecanduan'], function($query){
            $query->where('user_id', $this->id_user)->get();
        })->get();

        // foreach ($this->diagnosa_user as $value) {
        //     dd($value);
        //     }

    }
    public function render()
    {
        return view('livewire.admin-dashboard',[
            $this->all_kecanduan = Kecanduan::with(['gejalaKecanduan', 'solusiKecanduan'])->get(),
            $this->all_gejala = Gejala::with('kecanduanGejala')->get(),
            $this->all_solusi = Solusi::all(),
        ]);
    }
}

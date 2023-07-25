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
            $all_diagnosa,
            $all_solusi;


    public function mount()
    {
        $this->all_diagnosa = Diagnosa::with('user')->get();
    }

    public function render()
    {
        return view('livewire.admin-dashboard', [
            $this->all_kecanduan    = Kecanduan::select('id')->get(),
            $this->all_gejala       = Gejala::select('id')->get(),
            $this->all_solusi       = Solusi::select('id')->get(),
            $this->users            = User::with('diagnosa')->where('role_id', 2)->get()
        ]);
    }
}

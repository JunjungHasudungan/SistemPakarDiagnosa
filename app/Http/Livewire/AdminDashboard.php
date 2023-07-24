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
    public  $hasil_diag,
            $users,
            $diag_user,
            $all_kecanduan,
            $all_gejala,
            $all_solusi,
            $id_user;

    public function render()
    {
        return view('livewire.admin-dashboard', [
            $this->all_kecanduan    = Kecanduan::select('id')->get(),
            $this->all_gejala       = Gejala::select('id')->get(),
            $this->all_solusi       = Solusi::select('id')->get(),
            $this->users            = User::with(['diagnosa'])->where('role_id', 2)->get(),
        ]);
    }
}

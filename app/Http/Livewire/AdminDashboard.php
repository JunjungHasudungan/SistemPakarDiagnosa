<?php

namespace App\Http\Livewire;

use App\Models\{
    Kecanduan,
    Gejala,
    Solusi,
};
use Livewire\Component;

class AdminDashboard extends Component
{
    public $all_kecanduan = [];
    public $all_gejala = [];
    public $all_solusi = [];

    public function mount()
    {
        $this->all_kecanduan = Kecanduan::with(['gejalaKecanduan', 'solusiKecanduan'])->get();
        $this->all_gejala = Gejala::with('kecanduanGejala')->get();
        $this->all_solusi = Solusi::all();


    }
    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}

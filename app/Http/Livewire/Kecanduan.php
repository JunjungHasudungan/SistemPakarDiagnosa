<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kecanduan as Kecanduans;

class Kecanduan extends Component
{

    public  $create_modal = false,
            $edit_modal = false,
            $show_modal = false,
            $kecanduans,
            $id_kecanduan,
            $kode_kecanduan,
            $keteranganm;
    public function render()
    {
        return view('livewire.kecanduan', [
            $this->kecanduans = Kecanduans::all(),
        ]);
    }

    public function opencreateModal()
    {
        $this->create_modal = true;
    }

    public function closeCreateModal()
    {
        $this->create_modal = true;
    }

    public function openShowModal()
    {
        $this->show_modal = false;
    }

    public function detailKecanduan()
    {
        // $this->openShowModal();
        dd('Halaman Detail Kecanduan');
    }

    public function createKecanduan()
    {
        dd('Halaman Create Kecanduan');
    }
}

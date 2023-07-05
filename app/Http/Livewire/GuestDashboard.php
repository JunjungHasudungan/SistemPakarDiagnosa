<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GuestDashboard extends Component
{
    public $open_modal = false;

    public function render()
    {
        return view('livewire.guest-dashboard');
    }

    public function createOpenModal()
    {
        return $this->open_modal = true;
    }
}

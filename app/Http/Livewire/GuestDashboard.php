<?php

namespace App\Http\Livewire;

use Livewire\Component;

class GuestDashboard extends Component
{
    public  $open_modal = false,
            $pageTitle;

    public function render()
    {
        return view('livewire.guest-dashboard', [
            $this->pageTitle = 'Dashboard',
        ]);
    }

    public function createOpenModal()
    {
        return $this->open_modal = true;
    }
}

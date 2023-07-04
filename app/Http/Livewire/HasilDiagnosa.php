<?php

namespace App\Http\Livewire;

use App\Models\{
    TempDiagnosa,
};
use Livewire\Component;

class HasilDiagnosa extends Component
{

    public  $user_name,
            $id_user;

    public $all_result_diagnosis = [];
    public $count_id_user = [];

    public function mount()
    {
        $this->all_result_diagnosis = TempDiagnosa::with(['userDiagnosa'])->get();
       foreach ($this->all_result_diagnosis as $diagnosa) {
            $this->user_name = $diagnosa->userDiagnosa->name;
            $this->id_user = $diagnosa->userDiagnosa->user_id;
       }
    //    $this->count_id_user = count($this->id_user);
    }
    public function render()
    {
        return view('livewire.hasil-diagnosa');
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{
    Kecanduan,
    Gejala,
    Rule as Rules,
};

class Rule extends Component
{
    public  $open_modal = false,
            $kecanduans,
            $kecanduan_id,
            $gejalas,
            $no_aturan,
            $gejala_id;


    public $allGejala = [];
    public $gejala_kecanduan = [];

    public $rules = [
        'kecanduan_id'      => 'required',
        'no_aturan'         => 'required'
    ];

    public function mount()
    {
        $this->allGejala = Gejala::all();

        $this->gejala_kecanduan = [
            [
                'gejala_id'         => ''
            ]
        ];
    }

    public function render()
    {
        return view('livewire.rule',[
            $this->kecanduans = Kecanduan::all(),

            $this->rules = Rules::with('kecanduan')->get()
        ]);
    }

    public function openCreateModal()
    {
        $this->open_modal = true;
    }

    public function createRule()
    {
        $this->openCreateModal();

    }

    public function resetField()
    {
        $this->resetValidation(['kecanduan_id', 'no_aturan']);
    }

    public function storeRule()
    {
        $this->validate([
            'kecanduan_id'                  => 'required',
            'no_aturan'                     => 'required'
        ], [
            'kecanduan_id.required'         => 'Keterangan Kecanduan Wajib dipilih..',
            'no_aturan.required'            => 'Nomor Aturan Data Pakar Wajib dipilih'
        ]);

        $rule = new Rules();

        $rule = Rules::create([
            'kecanduan_id'          => $this->kecanduan_id,
            'no_aturan'             => $this->no_aturan,
        ]);

        $rule->save();

        $this->resetField();

        $this->closeCreateModal();

    }

    public function closeCreateModal()
    {
        $this->open_modal = false;
    }
}

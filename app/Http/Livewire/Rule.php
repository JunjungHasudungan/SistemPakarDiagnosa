<?php

namespace App\Http\Livewire;

use App\Helpers\RuleDataPakar;
use Livewire\Component;
use App\Models\{
    Kecanduan,
    Gejala,
    Rule as Rules,
    Solusi,
};

class Rule extends Component
{
    public  $open_modal = false,
            $solusis,
            $kecanduans,
            $kecanduan_id,
            $id_kecanduan,
            $rule_data_pakar,
            $gejalas,
            $keterangan,
            $keterangan_relasi,
            $gejala_id;


    public $allGejala = [];
    public $gejala_kecanduan = [];

    public $rules = [
        'kecanduan_id'              => 'required',
        'keterangan'                => 'required',
        // 'keterangan_relasi'         => 'required',
        // 'gejala_id'                 => 'required'
    ];

    public function mount()
    {
        $this->allGejala = Gejala::all();

        $this->gejala_kecanduan = [
            [
                'gejala_id'                         => '',
                'kecanduan_id'                      => '',
                'keterangan_relasi'                 => ''
            ]
        ];
    }

    public function render()
    {

        $this->rules = Rules::with('kecanduan')->get();

        foreach ($this->rules as $key => $item) {
           $this->id_kecanduan = $item->kecanduan_id;
        }

        $kecanduans = Kecanduan::with(['gejalaKecanduan', 'solusiKecanduan', 'rule'])->get();

        $solusis = Solusi::with(['kecanduanSolusi'], function($query){
            $query->where('kecanduan_id', $this->id_kecanduan)->groupBy('role')->get();
        })->get();
        return view('livewire.rule',[

            $this->kecanduans = $kecanduans,

            $this->solusis = $solusis,

            $this->rule_data_pakar = RuleDataPakar::Rules,
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
        $this->kecanduan_id = '';
        $this->keterangan = '';
        $this->gejala_id = '';
        $this->keterangan_relasi = '';
        $this->resetValidation(['kecanduan_id', 'keterangan', 'gejala_id', 'keterangan_relasi']);

        $this->gejala_kecanduan = [];
    }

    public function storeRule()
    {
        $this->validate([
            'kecanduan_id'                      => 'required',
            // 'gejala_id'                         => 'required',
            'keterangan'                        => 'required',
            // 'keterangan_relasi'                 => 'required'
        ], [
            'kecanduan_id.required'             => 'Keterangan Kecanduan Wajib dipilih..',
            'keterangan.required'               => 'Keterangan Aturan Data Pakar Wajib dipilih..',
            // 'gejala_id.required'                => 'Keterangan Gejala wajib dipilih...',
            // 'keterangan_relasi.required'        => 'Keterangan Relasi Wajib dipilih..'
        ]);

        $kecanduan = new Kecanduan();

        $rule = Rules::create([
            'kecanduan_id'          => $this->kecanduan_id,
            'keterangan'            => $this->keterangan,
        ]);

        foreach ($this->gejala_kecanduan as $gejala) {
            $rule->kecanduan()->attach($gejala['gejala_id'], [
                'keterangan_relasi'     => $gejala['keterangan_relasi'],
            ]);
            $gejala_id = $gejala['gejala_id'];

            dd($gejala_id);
        }

        $rule->save();

        $this->resetField();

        $this->closeCreateModal();

    }

    public function closeCreateModal()
    {
        $this->open_modal = false;

        $this->resetField();
    }

    public function removeGejala($index)
    {
        unset($this->gejala_kecanduan[$index]);

        $this->gejala_kecanduan = array_values($this->gejala_kecanduan);
    }

    public function addGejala()
    {
        $this->gejala_kecanduan[] = [
            'gejala_id'             => '',
            'keterangan_relasi'     => '',
            'kecanduan_id'          => ''
        ];
    }
}

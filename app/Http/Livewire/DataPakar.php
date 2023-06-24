<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{
    DataPakar as DataPakars,
    Gejala,
    GejalaKecanduan,
    Kecanduan
};

class DataPakar extends Component
{
    public  $open_modal = false,
            $edit_modal = false,
            $detail_modal = false,
            $cari_data_pakar = false,
            $no_aturan,
            $id_data_pakar,
            $kecanduan_id,
            $kecanduans,
            $gejalas,
            $gejala_id,
            $data_pakar;

    public $gejala_kecanduan = [];

    public $all_gejala = [];


    public function mount()
    {
        $this->all_gejala = Gejala::all();

        $this->gejala_kecanduan = [
            [
                'gejala_id'     => '',
            ]
        ];
    }

    public $rules = [
        'kecanduan_id'      => 'required',
        'gejala_id'         => 'required'
    ];

    public function render()
    {
        return view('livewire.data-pakar', [
            $this->kecanduans = Kecanduan::with(['level', 'gejalaKecanduan'])->get(),

            $this->data_pakar = DataPakars::with('gejalaKecanduan')->get(),

        ]);
    }

    public function opendModalCreate()
    {
        $this->open_modal = true;
    }

    public function createDataPakar()
    {
        $this->opendModalCreate();
    }

    public function resetField()
    {
        $this->kecanduan_id = '';

        $this->gejala_kecanduan = [];

        $this->resetValidation(['kecanduan_id', 'gejala_id']);
    }

    public function closeCreateModal()
    {
        $this->resetField();

        $this->resetValidation(['kecanduan_id', 'gejala_id']);

        $this->open_modal = false;

    }

    public function openModalEdit()
    {
        $this->edit_modal = true;
    }

    public function closeModalEdit()
    {
        $this->edit_modal = false;
    }

    public function storeDataPakar()
    {
        $this->validate([
            'kecanduan_id'              => 'required',
            // 'gejala_id'                 => 'required'
        ], [
            'kecanduan_id.required'     => 'Keterangan Kecanduan Wajib dipilih..',
            // 'gejala_id.required'        => 'Keterangan Gejala Wajib dipilih..'
        ]);


        $data_pakar = new DataPakars();
       $gejala = $data_pakar->gejala_id;

       $data_pakar = DataPakars::create([
        'kecanduan_id'      => $this->kecanduan_id,
        // 'gejala_id'         =>
       ]);


        foreach ($this->gejala_kecanduan as $key => $gejala) {
            $data_pakar->gejalaKecanduan()->attach($gejala['gejala_id'] ?? $gejala);

            $this->gejala_id = $gejala['gejala_id'];
        }

        $data_pakar->update([
            $data_pakar->gejala_id = $this->gejala_id
        ]);

        $this->closeModalCreate();

    }

    public function openModalDetail()
    {
        $this->detail_modal = true;
    }

    public function closeModalDetail()
    {
        $this->detail_modal = false;
    }

    public function editDataPakar($id_data_pakar)
    {
        dd('Halaman edit data pakar...');
    }

    public function detailDataPakar($id_data_pakar)
    {
        dd('Halaman detail data pakar...');
    }

    public function deleteConfirmation($id_data_pakar)
    {
        dd('Testing delete data pakar...');
    }

    public function addDataPakar()
    {
        $this->gejala_kecanduan[] = [
            'gejala_id'     => ''
        ];
    }

    public function removeDataPakar($index)
    {
        unset($this->gejala_kecanduan[$index]);

        $this->gejala_kecanduan = array_values($this->gejala_kecanduan);
    }
}

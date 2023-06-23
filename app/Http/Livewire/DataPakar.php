<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{
    DataPakar as DataPakars,
    GejalaKecanduan,
    Kecanduan
};

class DataPakar extends Component
{
    public  $open_modal = false,
            $edit_modal = false,
            $detail_modal = false,
            $cari_data_pakar = false,
            $id_data_pakar,
            $kecanduan_id,
            $kecanduans,
            $data_pakar;

    public $all_data_pakar = [];

    public function render()
    {
        return view('livewire.data-pakar', [
            $this->all_data_pakar = Kecanduan::with(['level', 'gejalaKecanduan'])->get(),
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

    }

    public function closeModalCreate()
    {
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
        dd('Halaman Store data pakar...');
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
}

<?php

namespace App\Http\Livewire;

use App\Models\{
    Kecanduan,
    Level,
    Solution,
};

use Livewire\Component;

class Solusi extends Component
{
    public  $open_modal = false,
            $show_modal = false,
            $edit_modal = false,
            $cari_solusi = false,
            $id_solution,
            $description,
            $level_id,
            $levels,
            $kecanduans,
            $kecanduan_id,
            $select_keterangan_kecanduan,
            $solutions;

    public $selectedLevel = null;
    public $selectedKecanduan = null;

    protected $rules = [
        ''
    ];

    public function mount($selectKecanduan = null)
    {
        $this->levels = Level::all();
        $this->kecanduans = collect();
        $this->selectedKecanduan = $selectKecanduan;

        if (!is_null($selectKecanduan)) {
            $kecanduan = Kecanduan::with('level')->find($selectKecanduan);
            if($kecanduan){
                $this->kecanduans = Kecanduan::where('level_id', $kecanduan->level_id)->get();
                $this->selectedKecanduan = $kecanduan->level->keterangan;
            }
        }
    }

    public function updatedSelectedKecanduan($kecanduan)
    {
        $this->kecanduans = Kecanduan::where('level_id', $kecanduan)->get();

        $this->selectedKecanduan = null;
    }

    public function render()
    {

        return view('livewire.solusi', [
            $this->solutions  = Solution::with('kecanduan')->get(),

            $this->kecanduans = Kecanduan::with(['level'])->get(),

        ]);
    }

    public function openModalCreate()
    {
        $this->open_modal = true;
    }

    public function closeModalCreate()
    {
        $this->open_modal = false;
    }

    public function createSolution()
    {
        $this->openModalCreate();

        // $this->validate([

        // ]);
        $solusi = new Solution();

    }

    public function openModalEdit()
    {
        $this->edit_modal = true;
    }

    public function editSolution($id_solution)
    {
        $this->id_solution = $id_solution;

    }

    public function closeModalEdit()
    {
        $this->edit_modal = false;
    }

    public function openModalDetail()
    {
        $this->show_modal = true;
    }

    public function detailSolution($id_solution)
    {
        dd('Halaman detail solusi');

        $this->id_solution = $id_solution;
    }

    public function closeModalDetail()
    {
        $this->show_modal = false;
    }

    public function resetField()
    {
        $this->description = '';
    }

    public function deleteConfirmation($id_solution)
    {
        $this->id_solution = $id_solution;
    }
}

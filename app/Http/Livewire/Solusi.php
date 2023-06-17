<?php

namespace App\Http\Livewire;

use App\Models\{
    Kecanduan,
    Level,
    Solution,
};

use App\Helpers\ForRole;
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
            $roles,
            $to_role,
            $solutions;

    // data penampung solusi kecanduan ketika  diisi waktu tombol penambahan solusi dilakukan
    public $solusi_kecanduan = [];

    protected $rules = [
        'kecanduan_id'      => 'required',
        'to_role'           => 'required',

    ];

    public function mount()
    {
        $this->solusi_kecanduan = [
            [
                'kecanduan_id'     => '',
            ]
        ];
    }

    public function render()
    {
        $this->kecanduans = Kecanduan::with(['level', 'solutions'])->get();
        // dd($this->kecanduans);

        foreach ($this->kecanduans as $kecanduan) {
                // dd($kecanduan->solutions);
        }
        return view('livewire.solusi', [
            $this->solutions  = Solution::with('kecanduan')->get(),

            $this->kecanduans = Kecanduan::with(['level', 'solutions'])->get(),

            $this->roles = ForRole::ForRole,

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

    public function editSolusi($id_solusi)
    {
        $this->id_solution = $id_solusi;

        dd($this->id_solution);

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
        $this->kecanduan_id = '';
        $this->solusi_kecanduan = [];
    }

    public function deleteConfirmation($id_solution)
    {
        $this->id_solution = $id_solution;
    }

    public function removeSolution($index)
    {
        // panggil ulang solusi_kecanduan untuk melepaskan data yang sudah diisi dalam array
       unset($this->solusi_kecanduan[$index]);

        // kembali kenilai awal array
        $this->solusi_kecanduan = array_values($this->solusi_kecanduan);
    }

    public function addSolution()
    {
    //    panggil solusi_kecanduan
        $this->solusi_kecanduan[] =
        [
            'kecanduan_id'      => '',
        ];
    }
}

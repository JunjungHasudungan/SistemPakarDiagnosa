<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kecanduan as Kecanduans;
use App\Helpers\ForRole;
use App\Models\Solution;

class Kecanduan extends Component
{

    public  $create_modal = false,
            $edit_modal = false,
            $show_modal = false,
            $cari_kecanduan = false,
            $kecanduans,
            $solutions,
            $all_kecanduan,
            $kecanduan,
            $id_kecanduan,
            $roles,
            $role,
            $kode_kecanduan,
            $level_id,
            $keterangan,
            $deskripsi;

    // sebagai penampung nilai array
    public $kecanduan_solusi = [];

    protected $listeners = [
        'deleteKecanduan'
    ];

    public $rules = [
        'solusi_id'         => 'required',
        'kode_kecanduan'    => 'required',
        'keterangan'        => 'required',      // field solutions
        'deskripsi'         => 'required',       // field kecanduans
        'role'              => 'required',
    ];
    public function mount()
    {
        $this->kecanduan_solusi = [
            [
                'solusi_id'     => '',
                'role'          => ''
            ]
        ];
    }

    public function render()
    {

        return view('livewire.kecanduan', [
            $this->kecanduans = Kecanduans::with(['level'])->get(),

            $this->solutions = Solution::all(),

            $this->roles = ForRole::ForRole,
        ]);
    }

    public function opencreateModal()
    {
        $this->create_modal = true;
    }

    public function closeCreateModal()
    {
        $this->create_modal = false;
    }

    public function openShowModal()
    {
        $this->show_modal = false;
    }

    public function openEditModal()
    {
        $this->edit_modal = true;
    }

    public function editKecanduan($id_kecanduan)
    {
        $kecanduan = Kecanduans::find($id_kecanduan);

        $this->openEditModal();

        $this->id_kecanduan = $id_kecanduan;

        $this->kode_kecanduan = $kecanduan->kode_kecanduan;

        $this->level_id = $kecanduan->level_id;

        $this->deskripsi = $kecanduan->deskripsi;
    }

    public function updateKecanduan($id_kecanduan)
    {
        $kecanduan = Kecanduans::find($id_kecanduan);

        // dd($this->id_kecanduan);
        $kecanduan->update([

            'kode_kecanduan'    => $this->kode_kecanduan,

            'level_id'             => $this->level_id,

            'deskripsi'         => $this->deskripsi,
        ]);

        $this->resetField();

        $this->closeEditModal();
    }

    public function closeEditModal()
    {
        $this->edit_modal = false;
    }

    public function detailKecanduan()
    {
        // $this->openShowModal();
        dd('Halaman Detail Kecanduan');
    }

    public function deleteConfirmation($id_kecanduan)
    {
        dd('id_kecanduan', $id_kecanduan);
    }

    public function deleteKecanduan($id)
    {
        Kecanduans::where('id', $id);
    }

    public function resetField()
    {
        $this->kode_kecanduan = '';
        $this->level_id = '';
        $this->deskripsi = '';
        $this->kecanduan_solusi = [];
    }

    public function createKecanduan()
    {
        $this->opencreateModal();

        $this->resetField();
    }

    public function storeKecanduan()
    {

        $this->validate([
            'kode_kecanduan'            => 'required',
            'level_id'                  => 'required',
            'deskripsi'                 => 'required',
            'role'                      => 'required',
            'keterangan'                => 'required',
        ],[
            'kode_kecanduan.unique'     => 'Kode Kecanduan Harus unik',
            'kode_kecanduan.required'   => 'Kode Kecanduan Wajib diisi..',
            'level_id'                  => 'Level Kecanduan wajib dipilih..',
            'deskripsi.required'        => 'Keterangan Kecanduan Wajib diisi..',
            'role.required'             => 'Untuk siapa wajib diisi..',
            'keterangan.required'       => 'Keterangan Solusi Wajib diisi..'
        ]);

        $kecanduan = Kecanduans::create([
            'kode_kecanduan'            => $this->kode_kecanduan,
            'level_id'                  => $this->level_id,
            'deskripsi'                 => $this->deskripsi,
        ]);

        $kecanduan->save();

        $this->closeCreateModal();

        $this->resetField();

        $this->dispatchBrowserEvent( 'toas:info', [
            'message'   => 'Data Berhasil Ditambahkan..'
        ]);

    }

    public function removeSolution($index)
    {

        unset($this->kecanduan_solusi[$index]);

        $this->kecanduan_solusi = array_values($this->kecanduan_solusi);
    }

    public function addSolution()
    {
        $this->kecanduan_solusi[] = [
            'solusi_id'     => '',
            'role'          => '',
        ];
    }
}
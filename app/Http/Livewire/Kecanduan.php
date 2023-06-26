<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\{
    Kecanduan as Kecanduans,
    Solusi,
    Gejala,
};
use App\Helpers\{
    ForRole,
    RuleDataPakar,
};

class Kecanduan extends Component
{

    public  $create_modal = false,
            $edit_modal = false,
            $show_modal = false,
            $cari_kecanduan = false,
            $kecanduans,
            $solusis,
            $solusi_id,
            $all_kecanduan,
            $keterangan_rule,
            $keterangan_relasi,
            $kecanduan,
            $id_kecanduan,
            $roles,
            $role,
            $kode_kecanduan,
            $level_kecanduan,
            $deskripsi_kecanduan,
            $level_id,
            $keterangan,
            $gejalas,
            $gejala,
            $gejala_id,
            $deskripsi;

    // sebagai penampung nilai array
    public $kecanduan_solusi = [];
    public $kecanduan_gejala = []; // sebagai penampung nilai array kecanduan_gejala

    public $all_solusi = [];
    public $all_gejala = []; // sebagai penampung nilai gejala
    protected $listeners = [
        'deleteKecanduan'
    ];

    public $rules = [
        'kode_kecanduan'    => 'required',
        'deskripsi'         => 'required',       // field kecanduans
        // 'keterangan_relasi' => 'required'
    ];

    public function mount()
    {
        $this->all_kecanduan = Solusi::all();
        $this->all_gejala = Gejala::all();

        $this->kecanduan_solusi = [
            [
                'solusi_id'     => '',
                'role'          => ''
            ]
        ];

        $this->kecanduan_gejala = [
            [
                'gejala_id'             => '',
                'keterangan_relasi'     => ''
            ]
        ];
    }

    public function render()
    {

        return view('livewire.kecanduan', [
            $this->kecanduans = Kecanduans::with(['level', 'gejalaKecanduan', 'solusiKecanduan'])->get(),

            $this->keterangan_rule = RuleDataPakar::DescriptionRules,

            $this->roles = ForRole::ForRole,
        ]);
    }

    public function opencreateModal()
    {
        $this->create_modal = true;
    }

    public function closeCreateModal()
    {

        $this->resetValidation();

        $this->create_modal = false;
    }

    public function openShowModal()
    {
        $this->show_modal = true;
    }

    public function openEditModal()
    {
        $this->edit_modal = true;
    }

    public function editKecanduan($id_kecanduan)
    {
        $kecanduan = Kecanduans::find($id_kecanduan);

        $koleksi_kecanduan = collect($kecanduan);

        $this->openEditModal();

        $this->id_kecanduan = $id_kecanduan;

        $this->kode_kecanduan = $kecanduan->kode_kecanduan;

        $this->level_id = $kecanduan->level_id;

        $this->deskripsi = $kecanduan->deskripsi;

        if($koleksi_kecanduan->isNotEmpty()){
            $this->resetValidation([
                'kode_kecanduan',
                'level_id',
                'deskripsi',
                'solusi_id',
                'role',
                'gejala_id',
                'keterangan_relasi'
        ]);
        }
    }

    public function updateKecanduan($id_kecanduan)
    {
        $kecanduan = Kecanduans::find($id_kecanduan);

        // dd($id_kecanduan);
        $this->validate([
            'kode_kecanduan'                => 'required',
            'level_id'                      => 'required',
            'deskripsi'                     => 'required',
            'role'                          => 'required',
            'solusi_id'                     => 'required',
            'gejala_id'                     => 'required',
            'keterangan_relasi'             => 'required'
        ],[
            'kode_kecanduan.required'       => 'Kode Kecanduan wajib diisi...',
            'level_id'                      => 'Level Kecanduan wajib diisi...',
            'deskripsi'                     => 'Keterangan kecanduan wajib diisi..',
            'role.required'                 => 'inputan untuk siapa wajib dipilih..',
            'solusi_id.required'            => 'Keterangan Solusi Wajib dipilih..',
            'gejala_id'                     => 'Keterangan Gejala wajib dipilih..',
            'keterangan_relasi'             => 'Keterangan Relasi wajib dipilih..'
        ]);

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

    public function detailKecanduan($id_kecanduan)
    {
        $this->openShowModal();

        $kecanduan = Kecanduans::with(['gejalaKecanduan', 'solusiKecanduan'], function($query) use($id_kecanduan){
            $query->where('kecanduan_id', $id_kecanduan)->get();
        })->find($id_kecanduan);

        $this->gejalas = $kecanduan->gejalaKecanduan;
        $this->solusis = $kecanduan->solusiKecanduan;
        $this->kode_kecanduan = $kecanduan->kode_kecanduan;
        $this->level_kecanduan = $kecanduan->level->keterangan;
        $this->deskripsi_kecanduan = $kecanduan->deskripsi;
    }

    public function closeDetailKecanduan()
    {
        $this->show_modal = false;
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
        $this->kecanduan_gejala = [];

        $this->resetValidation(['kode_kecanduan', 'level_id', 'deskripsi']);
    }

    public function createKecanduan()
    {
        $this->opencreateModal();

        $this->resetField();
    }

    public function storeKecanduan()
    {
        $this->validate([
            'kode_kecanduan'                => 'required|unique:kecanduans|string|max:4|min:3',
            'level_id'                      => 'required',
            'deskripsi'                     => 'required',
            // 'keterangan_relasi'             => 'required',
        ],[
            'kode_kecanduan.unique'         => 'Kode Kecanduan sudah digunakan..',
            'kode_kecanduan.max'            => 'Kode Keecanduan maks 4 karakter',
            'kode_kecanduan.required'       => 'Kode Kecanduan Wajib diisi..',
            'level_id'                      => 'Level Kecanduan wajib dipilih..',
            'deskripsi.required'            => 'Keterangan Kecanduan Wajib diisi..',
            // 'keterangan_relasi.required'    => 'Keterangan Relasi Wajib dipilih..'
        ]);

        $kecanduan = Kecanduans::create([
            'kode_kecanduan'            => $this->kode_kecanduan,
            'level_id'                  => $this->level_id,
            'deskripsi'                 => $this->deskripsi,
        ]);

        // lakukan perulangan untuk kecanduan_solusi
        foreach ($this->kecanduan_solusi as $solusi) {
           $kecanduan->solusiKecanduan()->attach($solusi['solusi_id'],
            [
                'role'      => $solusi['role'],
            ]);
        }

        foreach ($this->kecanduan_gejala as $key => $gejala) {
            $kecanduan->gejalaKecanduan()->attach($gejala['gejala_id'],
        [
            'keterangan_relasi'     => $gejala['keterangan_relasi']
        ]);
        }

        $kecanduan->save();

        // dd('Data Berhasil ditambahkan..');
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

    public function removeDataGejala($index)
    {
        unset($this->kecanduan_gejala[$index]);

        $this->kecanduan_gejala = array_values($this->kecanduan_gejala);
    }

    public function addSolution()
    {
        $this->kecanduan_solusi[] = [
            'solusi_id'     => '',
            'role'          => '',
        ];
    }

    public function addDataGejala()
    {
        $this->kecanduan_gejala[] = [
            'gejala_id'             => '',
            'keterangan_relasi'     => ''
        ];
    }
}

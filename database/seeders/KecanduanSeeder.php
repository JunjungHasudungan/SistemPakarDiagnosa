<?php

namespace Database\Seeders;

use App\Models\Kecanduan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecanduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kecanduans = [
            [
                'kode_kecanduan'        => 'JK01',
                'level'                 => 'rendah',
                'deskripsi'             => 'butuh pengawasan'
            ],
            [
                'kode_kecanduan'        => 'JK02',
                'level'                 => 'Sedang',
                'deskripsi'             => 'Perlu Tindakan Segera'
            ],
        ];

        Kecanduan::insert($kecanduans);
    }
}

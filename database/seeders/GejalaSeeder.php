<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gejalas = [
            [
                'kode_gejala'       => 'KG01',
                'keterangan'        => 'Menonton Pornografi Merasa senang',
                // 'kecanduan_id'      => 1,
            ],
            [
                'kode_gejala'       => 'KG02',
                'keterangan'        => 'Menonton Pornografi Setiap Hari',
                // 'kecanduan_id'      => 1,
            ],
        ];

        Gejala::insert($gejalas);
    }
}

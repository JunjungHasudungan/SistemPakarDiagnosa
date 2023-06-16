<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
          [
            'keterangan'        => 'rendah'
          ],
          [
            'keterangan'        => 'sedang'
          ],
          [
            'keterangan'        => 'Tinggi'
          ]
        ];

        Level::insert($levels);
    }
}

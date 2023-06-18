<?php

namespace Database\Seeders;

use App\Models\Solusi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $solutions = [
            [
                'keterangan'        => 'Batasi akses terhadap situs pornografi',
            ],
            [
                'keterangan'        => 'Test Solusi Kedua',
            ]
        ];
        Solusi::insert($solutions);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Solution;
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
                'kecanduan_id'      => 1,
            ],
            [
                'keterangan'        => 'Test Solusi Kedua',
                'kecanduan_id'      => 1,
            ]
        ];
        Solution::insert($solutions);
    }
}

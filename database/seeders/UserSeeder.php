<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'          => 'Vincent',
                'email'         => 'vincent@gmail.com',
                'password'      => bcrypt('password'),
                'role_id'       => 1
            ],
            [
                'name'          => 'Hasudungan',
                'email'         => 'hasudungan@gmail.com',
                'password'      => bcrypt('password'),
                'role_id'       => 2
            ]
        ];

        User::insert($users);
    }
}

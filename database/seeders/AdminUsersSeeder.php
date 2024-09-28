<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'Nature',
                'password' => bcrypt('password1'),
                'tribe' => 0,
                'access' => 9,
            ],
            [
                'username' => 'Taskmaster',
                'password' => bcrypt('password1'),
                'tribe' => 0,
                'access' => 8,
            ],
            [
                'username' => 'Support',
                'password' => bcrypt('password1'),
                'tribe' => 0,
                'access' => 8,
            ],
            [
                'username' => 'Multihunter',
                'password' => bcrypt('password1'),
                'tribe' => 0,
                'access' => 9,
            ],
        ]);
    }
}

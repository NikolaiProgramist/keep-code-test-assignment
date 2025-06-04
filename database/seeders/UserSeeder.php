<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Nikolai',
            'email' => 'admin@mail.ru',
            'password' => '$2y$12$IAVrACTvKAcaGr25tZ4vlec45df1RHB941zkJGD5zw6Scus/asNqa',
            'cash' => 9999999,
            'role' => 'admin'
        ]);
    }
}

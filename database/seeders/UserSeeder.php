<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'username' => 'faiz',
                'email' => 'feifeifry@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'username' => 'rama',
                'email' => 'yoonionk@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'pelamar',
            ],
            [
                'username' => 'anantha',
                'email' => 'ananthamarcellino@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'pelamar',
            ],
        ]);
    }
}

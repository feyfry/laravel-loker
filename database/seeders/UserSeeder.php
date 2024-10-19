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
                'username' => 'feyfry',
                'email' => 'feifeifry@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'username' => 'shilfaa',
                'email' => 'shilfaashaphiera@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'pelamar',
            ],
        ]);
    }
}

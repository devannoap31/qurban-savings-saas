<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin'
        ]);

        User::create([
            'name' => 'Admin Masjid Zayed',
            'email' => 'admin@zayed.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Devanno Andhika',
            'email' => 'jemaah@example.com',
            'password' => Hash::make('password'),
            'role' => 'jemaah'
        ]);
    }
}

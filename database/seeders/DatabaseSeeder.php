<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Masjid;
use App\Models\HewanKurban;
use App\Models\Jemaah;
use App\Models\Setoran;
use App\Models\Pengeluaran;
use Faker\Factory as Faker;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Superadmin
        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin'
        ]);
    }
}

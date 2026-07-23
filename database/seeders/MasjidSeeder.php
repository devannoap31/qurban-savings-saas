<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Masjid;
use App\Models\User;

class MasjidSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@zayed.com')->first();
        
        if ($admin) {
            Masjid::create([
                'admin_id' => $admin->id,
                'name' => 'Masjid Raya Sheikh Zayed',
                'address' => 'Jl. Ahmad Yani No. 128, Gilingan',
                'city' => 'Surakarta'
            ]);
        }
    }
}

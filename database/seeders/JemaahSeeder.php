<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jemaah;
use App\Models\User;
use App\Models\Masjid;
use App\Models\HewanKurban;

class JemaahSeeder extends Seeder
{
    public function run(): void
    {
        $userJemaah = User::where('email', 'jemaah@example.com')->first();
        $masjid = Masjid::where('name', 'Masjid Raya Sheikh Zayed')->first();
        $hewan = HewanKurban::where('masjid_id', $masjid->id ?? 0)->first();
        
        if ($userJemaah && $masjid && $hewan) {
            Jemaah::create([
                'user_id' => $userJemaah->id,
                'masjid_id' => $masjid->id,
                'hewan_kurban_id' => $hewan->id,
                'nama_jemaah' => 'Devanno Andhika',
                'total_saldo' => 2500000,
                'status' => 'Sedang Menabung'
            ]);
        }
    }
}

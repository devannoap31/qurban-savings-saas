<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setoran;
use App\Models\Jemaah;
use Carbon\Carbon;

class SetoranSeeder extends Seeder
{
    public function run(): void
    {
        $jemaah = Jemaah::where('nama_jemaah', 'Devanno Andhika')->first();
        
        if ($jemaah) {
            Setoran::create([
                'masjid_id' => $jemaah->masjid_id,
                'jemaah_id' => $jemaah->id,
                'nominal' => 1500000,
                'tanggal_setor' => Carbon::now()->subDays(10),
            ]);

            Setoran::create([
                'masjid_id' => $jemaah->masjid_id,
                'jemaah_id' => $jemaah->id,
                'nominal' => 1000000,
                'tanggal_setor' => Carbon::now()->subDays(2),
            ]);
        }
    }
}

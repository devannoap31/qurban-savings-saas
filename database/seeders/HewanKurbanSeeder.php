<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HewanKurban;
use App\Models\Masjid;

class HewanKurbanSeeder extends Seeder
{
    public function run(): void
    {
        $masjid = Masjid::where('name', 'Masjid Raya Sheikh Zayed')->first();
        
        if ($masjid) {
            HewanKurban::create([
                'masjid_id' => $masjid->id,
                'jenis_hewan' => 'Sapi',
                'deskripsi' => 'Sapi A (Sapi Limosin)',
                'harga_total' => 24500000,
                'kapasitas_slot' => 7,
                'target_per_slot' => 3500000,
                'slot_terisi' => 1
            ]);
        }
    }
}

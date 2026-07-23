<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengeluaran;
use App\Models\HewanKurban;
use Carbon\Carbon;

class PengeluaranSeeder extends Seeder
{
    public function run(): void
    {
        $hewan = HewanKurban::where('deskripsi', 'Sapi A (Sapi Limosin)')->first();
        
        if ($hewan) {
            Pengeluaran::create([
                'masjid_id' => $hewan->masjid_id,
                'hewan_kurban_id' => $hewan->id,
                'nama_pengeluaran' => 'DP Sapi Limosin Sapi A',
                'nominal' => 5000000,
                'tanggal' => Carbon::now()->subDays(15),
            ]);
            
            Pengeluaran::create([
                'masjid_id' => $hewan->masjid_id,
                'hewan_kurban_id' => $hewan->id,
                'nama_pengeluaran' => 'Beli plastik dan bambu',
                'nominal' => 500000,
                'tanggal' => Carbon::now(),
            ]);
        }
    }
}

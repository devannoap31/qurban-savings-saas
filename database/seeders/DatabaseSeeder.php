<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Masjid;
use App\Models\HewanKurban;
use App\Models\Jemaah;
use App\Models\Setoran;
use App\Models\Pengeluaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Superadmin
        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin'
        ]);

        // 2. Buat Admin Masjid
        $admin = User::create([
            'name' => 'Admin Masjid Zayed',
            'email' => 'admin@zayed.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // 3. Buat Masjid untuk Admin tersebut
        $masjid = Masjid::create([
            'admin_id' => $admin->id,
            'name' => 'Masjid Raya Sheikh Zayed',
            'address' => 'Jl. Ahmad Yani No. 128, Gilingan',
            'city' => 'Surakarta'
        ]);

        // 4. Buat User Jemaah
        $userJemaah = User::create([
            'name' => 'Devanno Andhika',
            'email' => 'jemaah@example.com',
            'password' => Hash::make('password'),
            'role' => 'jemaah'
        ]);

        // 5. Buat Unit Hewan Kurban di Masjid
        $hewan = HewanKurban::create([
            'masjid_id' => $masjid->id,
            'jenis_hewan' => 'Sapi',
            'deskripsi' => 'Sapi A (Sapi Limosin)',
            'harga_total' => 24500000,
            'kapasitas_slot' => 7,
            'target_per_slot' => 3500000,
            'slot_terisi' => 1
        ]);

        // 6. Daftarkan Jemaah ke Hewan Kurban tersebut
        $jemaah = Jemaah::create([
            'user_id' => $userJemaah->id,
            'masjid_id' => $masjid->id,
            'hewan_kurban_id' => $hewan->id,
            'nama_jemaah' => 'Devanno Andhika',
            'total_saldo' => 2500000,
            'status' => 'Sedang Menabung'
        ]);

        // 7. Buat histori setoran
        Setoran::create([
            'masjid_id' => $masjid->id,
            'jemaah_id' => $jemaah->id,
            'nominal' => 1500000,
            'tanggal_setor' => Carbon::now()->subDays(10),
        ]);

        Setoran::create([
            'masjid_id' => $masjid->id,
            'jemaah_id' => $jemaah->id,
            'nominal' => 1000000,
            'tanggal_setor' => Carbon::now()->subDays(2),
        ]);

        // 8. Buat histori pengeluaran
        Pengeluaran::create([
            'masjid_id' => $masjid->id,
            'hewan_kurban_id' => $hewan->id,
            'nama_pengeluaran' => 'DP Sapi Limosin Sapi A',
            'nominal' => 5000000,
            'tanggal' => Carbon::now()->subDays(15),
        ]);
        
        Pengeluaran::create([
            'masjid_id' => $masjid->id,
            'hewan_kurban_id' => $hewan->id,
            'nama_pengeluaran' => 'Beli plastik dan bambu',
            'nominal' => 500000,
            'tanggal' => Carbon::now(),
        ]);
    }
}

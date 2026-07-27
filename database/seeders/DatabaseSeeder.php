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
        $faker = Faker::create('id_ID');

        // Create Superadmin
        User::create([
            'name' => 'Superadmin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password'),
            'role' => 'superadmin'
        ]);

        // Create 30 Masjids and related data
        for ($i = 1; $i <= 30; $i++) {
            // 1. Admin
            $admin = User::create([
                'name' => "Admin " . $faker->company,
                'email' => "admin{$i}@masjid.com",
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]);

            // 2. Masjid
            $masjid = Masjid::create([
                'admin_id' => $admin->id,
                'name' => 'Masjid ' . $faker->company,
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'gambar' => 'https://picsum.photos/seed/masjid' . $i . '/600/400',
            ]);

            // 3. Hewan Kurban
            $hewan = HewanKurban::create([
                'masjid_id' => $masjid->id,
                'jenis_hewan' => $faker->randomElement(['Sapi', 'Kambing']),
                'deskripsi' => 'Tipe ' . $faker->randomElement(['A', 'B', 'Super', 'Premium']),
                'harga_total' => $faker->randomElement([3000000, 21000000, 25000000]),
                'kapasitas_slot' => $faker->randomElement([1, 7]),
                'slot_terisi' => 1,
                'target_per_slot' => 3000000
            ]);

            // 4. Jemaah
            if ($i === 1) { // Buat 1 Jemaah khusus untuk testing di Masjid 1
                $jemaahUser = User::create([
                    'name' => 'Devanno Andhika',
                    'email' => 'jemaah@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'jemaah'
                ]);

                $jemaah = Jemaah::create([
                    'user_id' => $jemaahUser->id,
                    'masjid_id' => $masjid->id,
                    'hewan_kurban_id' => $hewan->id,
                    'nama_jemaah' => 'Devanno Andhika',
                    'total_saldo' => 1000000,
                    'status' => 'Sedang Menabung'
                ]);
            } else {
                $jemaahUser = User::create([
                    'name' => $faker->name,
                    'email' => "jemaah{$i}@example.com",
                    'password' => Hash::make('password'),
                    'role' => 'jemaah'
                ]);

                $jemaah = Jemaah::create([
                    'user_id' => $jemaahUser->id,
                    'masjid_id' => $masjid->id,
                    'hewan_kurban_id' => $hewan->id,
                    'nama_jemaah' => $jemaahUser->name,
                    'total_saldo' => 1000000,
                    'status' => 'Sedang Menabung'
                ]);
            }

            // 5. Setoran
            Setoran::create([
                'masjid_id' => $masjid->id,
                'jemaah_id' => $jemaah->id,
                'nominal' => 500000,
                'tanggal_setor' => Carbon::now()->subMonths(2)
            ]);
            
            Setoran::create([
                'masjid_id' => $masjid->id,
                'jemaah_id' => $jemaah->id,
                'nominal' => 500000,
                'tanggal_setor' => Carbon::now()->subMonths(1)
            ]);

            // 6. Pengeluaran
            Pengeluaran::create([
                'masjid_id' => $masjid->id,
                'hewan_kurban_id' => $hewan->id,
                'nama_pengeluaran' => 'Biaya Pemeliharaan',
                'nominal' => 50000,
                'tanggal' => Carbon::now()->subDays(10)
            ]);
        }
    }
}

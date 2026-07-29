<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Masjid;
use App\Models\HewanKurban;
use App\Models\Jemaah;
use App\Models\Setoran;
use App\Models\Pengeluaran;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Asumsi admin mengelola 1 masjid untuk saat ini
        $masjid = Masjid::where('admin_id', $user->id)->first();
        
        if (!$masjid) {
            // Bisa redirect ke halaman setup profil masjid jika belum ada
            return "Anda belum memiliki data masjid yang dikelola.";
        }

        $hewanKurbans = HewanKurban::where('masjid_id', $masjid->id)->get();
        $jemaahs = Jemaah::with('hewanKurban')->where('masjid_id', $masjid->id)->get();
        $setorans = Setoran::with('jemaah')->where('masjid_id', $masjid->id)->latest()->get();
        $pengeluarans = Pengeluaran::with('hewanKurban')->where('masjid_id', $masjid->id)->latest()->get();
        
        // Kalkulasi dashboard overview
        $totalSetoran = $jemaahs->sum('total_saldo');
        $totalPengeluaran = $pengeluarans->sum('nominal');
        $totalSaldoTerkumpul = $totalSetoran - $totalPengeluaran; // Saldo Akhir / Net Balance
        
        // Gabungkan Setoran dan Pengeluaran untuk Riwayat Transaksi
        $riwayatTransaksi = collect();
        foreach($setorans as $setoran) {
            $riwayatTransaksi->push([
                'id' => 'S-' . $setoran->id,
                'tipe' => 'Pemasukan',
                'tanggal' => $setoran->tanggal_setor,
                'keterangan' => 'Setoran Kurban: ' . ($setoran->jemaah->nama_jemaah ?? 'Jemaah'),
                'nominal' => $setoran->nominal,
                'timestamp' => $setoran->created_at->timestamp,
            ]);
        }
        foreach($pengeluarans as $pengeluaran) {
            $riwayatTransaksi->push([
                'id' => 'P-' . $pengeluaran->id,
                'tipe' => 'Pengeluaran',
                'tanggal' => $pengeluaran->tanggal,
                'keterangan' => $pengeluaran->nama_pengeluaran . ' (' . ($pengeluaran->hewanKurban->jenis_hewan ?? 'Hewan') . ')',
                'nominal' => $pengeluaran->nominal,
                'timestamp' => $pengeluaran->created_at->timestamp,
            ]);
        }
        // Urutkan default dari terbaru
        $riwayatTransaksi = $riwayatTransaksi->sortByDesc('timestamp')->values();
        
        return view('admin.dashboard', compact(
            'masjid', 
            'hewanKurbans', 
            'jemaahs', 
            'setorans', 
            'pengeluarans',
            'totalSaldoTerkumpul',
            'riwayatTransaksi'
        ));
    }

    public function cetakLaporan()
    {
        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();
        
        $hewanKurbans = HewanKurban::where('masjid_id', $masjid->id)->get();
        $jemaahs = Jemaah::with('hewanKurban')->where('masjid_id', $masjid->id)->get();
        $setorans = Setoran::with('jemaah')->where('masjid_id', $masjid->id)->get();
        $pengeluarans = Pengeluaran::with('hewanKurban')->where('masjid_id', $masjid->id)->get();
        
        $totalSetoran = $jemaahs->sum('total_saldo');
        $totalPengeluaran = $pengeluarans->sum('nominal');
        $totalSaldoTerkumpul = $totalSetoran - $totalPengeluaran;
        
        $riwayatTransaksi = collect();
        foreach($setorans as $setoran) {
            $riwayatTransaksi->push([
                'id' => 'S-' . $setoran->id,
                'tipe' => 'Pemasukan',
                'tanggal' => $setoran->tanggal_setor,
                'keterangan' => 'Setoran Kurban: ' . ($setoran->jemaah->nama_jemaah ?? 'Jemaah'),
                'nominal' => $setoran->nominal,
                'timestamp' => \Carbon\Carbon::parse($setoran->tanggal_setor)->timestamp,
            ]);
        }
        foreach($pengeluarans as $pengeluaran) {
            $riwayatTransaksi->push([
                'id' => 'P-' . $pengeluaran->id,
                'tipe' => 'Pengeluaran',
                'tanggal' => $pengeluaran->tanggal,
                'keterangan' => $pengeluaran->nama_pengeluaran . ' (' . ($pengeluaran->hewanKurban->jenis_hewan ?? 'Hewan') . ')',
                'nominal' => $pengeluaran->nominal,
                'timestamp' => \Carbon\Carbon::parse($pengeluaran->tanggal)->timestamp,
            ]);
        }
        
        // Urutkan dari yang terlama ke terbaru untuk laporan PDF (buku kas format)
        $riwayatTransaksi = $riwayatTransaksi->sortBy('timestamp')->values();
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.laporan-pdf', compact(
            'masjid', 
            'hewanKurbans', 
            'jemaahs', 
            'setorans', 
            'pengeluarans',
            'totalSaldoTerkumpul',
            'totalSetoran',
            'totalPengeluaran',
            'riwayatTransaksi'
        ));
        
        return $pdf->download('laporan-rekapitulasi-kurban-' . \Illuminate\Support\Str::slug($masjid->name) . '.pdf');
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'nullable|url',
        ]);

        if (!$request->hasFile('image_file') && !$request->filled('image_url')) {
            return back()->with('error', 'Silakan pilih file gambar atau masukkan URL gambar.');
        }

        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();

        // Check if there's an existing image and it's a local file (not starting with http)
        if ($masjid->gambar && !str_starts_with($masjid->gambar, 'http')) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($masjid->gambar);
        }

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('masjids', 'public');
            $masjid->gambar = $path;
        } elseif ($request->filled('image_url')) {
            $masjid->gambar = $request->image_url;
        }

        $masjid->save();

        return back()->with('success', 'Gambar masjid berhasil diperbarui.');
    }

    public function storeHewan(Request $request)
    {
        $request->validate([
            'jenis_hewan' => 'required|string|in:Sapi,Kambing,Domba',
            'deskripsi' => 'required|string|max:255',
            'harga_total' => 'required|numeric|min:0',
            'kapasitas_slot' => 'required|integer|min:1',
            'target_per_slot' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();

        HewanKurban::create([
            'masjid_id' => $masjid->id,
            'jenis_hewan' => $request->jenis_hewan,
            'deskripsi' => $request->deskripsi,
            'harga_total' => $request->harga_total,
            'kapasitas_slot' => $request->kapasitas_slot,
            'target_per_slot' => $request->target_per_slot,
            'slot_terisi' => 0
        ]);

        return back()->with('success', 'Data hewan kurban berhasil ditambahkan.');
    }

    public function updateHewan(Request $request, $id)
    {
        $request->validate([
            'jenis_hewan' => 'required|string|max:50',
            'deskripsi' => 'required|string|max:255',
            'harga_total' => 'required|numeric|min:0',
            'kapasitas_slot' => 'required|integer|min:1',
            'target_per_slot' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();
        
        $hewan = HewanKurban::where('id', $id)->where('masjid_id', $masjid->id)->firstOrFail();
        
        // Cek jika slot terisi lebih besar dari kapasitas baru
        if ($hewan->slot_terisi > $request->kapasitas_slot) {
            return back()->with('error', 'Kapasitas slot tidak boleh kurang dari jumlah slot yang sudah terisi (' . $hewan->slot_terisi . ').');
        }

        $hewan->update([
            'jenis_hewan' => $request->jenis_hewan,
            'deskripsi' => $request->deskripsi,
            'harga_total' => $request->harga_total,
            'kapasitas_slot' => $request->kapasitas_slot,
            'target_per_slot' => $request->target_per_slot,
        ]);

        return back()->with('success', 'Data hewan kurban berhasil diperbarui.');
    }

    public function storeSetoran(Request $request)
    {
        $request->validate([
            'jemaah_id' => 'required|exists:jemaahs,id',
            'nominal' => 'required|numeric|min:1000',
            'tanggal_setor' => 'required|date',
        ]);

        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();

        // Pastikan jemaah tersebut milik masjid admin ini
        $jemaah = Jemaah::where('id', $request->jemaah_id)
                        ->where('masjid_id', $masjid->id)
                        ->firstOrFail();

        // 1. Simpan riwayat setoran
        Setoran::create([
            'jemaah_id' => $jemaah->id,
            'masjid_id' => $masjid->id,
            'nominal' => $request->nominal,
            'tanggal_setor' => $request->tanggal_setor,
            'metode_pembayaran' => 'Manual (Tunai/Transfer)',
            'status' => 'Dikonfirmasi'
        ]);

        // 2. Tambahkan saldo jemaah
        $jemaah->total_saldo += $request->nominal;

        // 3. Perbarui status jika perlu
        if ($jemaah->total_saldo > 0 && $jemaah->status === 'Belum Mulai') {
            $jemaah->status = 'Sedang Menabung';
        }
        
        $hewanKurban = $jemaah->hewanKurban;
        if ($hewanKurban && $jemaah->total_saldo >= $hewanKurban->target_per_slot) {
            $jemaah->status = 'Lunas';
        }

        $jemaah->save();

        return back()->with('success', 'Setoran berhasil dicatat dan saldo Jemaah diperbarui.');
    }

    public function removeImage()
    {
        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();

        if ($masjid->gambar) {
            if (!str_starts_with($masjid->gambar, 'http')) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($masjid->gambar);
            }
            $masjid->gambar = null;
            $masjid->save();
            return back()->with('success', 'Gambar masjid berhasil dihapus.');
        }

        return back()->with('error', 'Tidak ada gambar untuk dihapus.');
    }

    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'hewan_kurban_id' => 'required|exists:hewan_kurbans,id',
            'nama_pengeluaran' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:0',
            'tanggal' => 'required|date'
        ]);

        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();

        // Pastikan hewan tersebut milik masjid admin ini
        $hewan = HewanKurban::where('id', $request->hewan_kurban_id)
                        ->where('masjid_id', $masjid->id)
                        ->firstOrFail();

        Pengeluaran::create([
            'masjid_id' => $masjid->id,
            'hewan_kurban_id' => $hewan->id,
            'nama_pengeluaran' => $request->nama_pengeluaran,
            'nominal' => $request->nominal,
            'tanggal' => $request->tanggal
        ]);

        return back()->with('success', 'Data pengeluaran berhasil dicatat.');
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kontak_person' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();

        $masjid->update($request->only(['name', 'address', 'city', 'deskripsi', 'kontak_person']));

        return back()->with('success', 'Profil masjid berhasil diperbarui.');
    }

    public function storeRekening(Request $request)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'nomor_rekening' => 'required|string|max:255',
            'atas_nama' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();

        \App\Models\MasjidRekening::create([
            'masjid_id' => $masjid->id,
            'platform' => $request->platform,
            'nomor_rekening' => $request->nomor_rekening,
            'atas_nama' => $request->atas_nama,
        ]);

        return back()->with('success', 'Informasi rekening/pembayaran berhasil ditambahkan.');
    }

    public function updateRekening(Request $request, $id)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'nomor_rekening' => 'required|string|max:255',
            'atas_nama' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();
        
        $rekening = \App\Models\MasjidRekening::where('id', $id)
                        ->where('masjid_id', $masjid->id)
                        ->firstOrFail();

        $rekening->update([
            'platform' => $request->platform,
            'nomor_rekening' => $request->nomor_rekening,
            'atas_nama' => $request->atas_nama,
        ]);

        return back()->with('success', 'Informasi rekening/pembayaran berhasil diperbarui.');
    }

    public function destroyRekening($id)
    {
        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();
        
        $rekening = \App\Models\MasjidRekening::where('id', $id)
                        ->where('masjid_id', $masjid->id)
                        ->firstOrFail();

        $rekening->delete();

        return back()->with('success', 'Metode pembayaran berhasil dihapus.');
    }

    public function batalJemaah($id)
    {
        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();
        
        $jemaah = Jemaah::where('id', $id)->where('masjid_id', $masjid->id)->firstOrFail();

        // Validasi: Jika sudah menabung, tidak bisa dibatalkan
        if ($jemaah->total_saldo > 0) {
            return back()->with('error', 'Jemaah tidak dapat dibatalkan karena sudah mulai menabung. Saldo: Rp ' . number_format($jemaah->total_saldo, 0, ',', '.'));
        }

        // Kembalikan slot terisi hewan kurban
        if ($jemaah->hewanKurban) {
            $hewan = $jemaah->hewanKurban;
            if ($hewan->slot_terisi > 0) {
                $hewan->decrement('slot_terisi');
            }
        }

        // Hapus Jemaah dari sistem
        $jemaah->delete();

        return back()->with('success', 'Pendaftaran Jemaah berhasil dibatalkan dan slot dikembalikan.');
    }

    public function storeJemaah(Request $request)
    {
        $user = Auth::user();
        $masjid = Masjid::where('admin_id', $user->id)->firstOrFail();

        $request->validate([
            'nama_jemaah' => 'required|string|min:3|max:255',
            'hewan_kurban_id' => 'required|exists:hewan_kurbans,id',
        ]);

        $hewan = HewanKurban::where('id', $request->hewan_kurban_id)
                    ->where('masjid_id', $masjid->id)
                    ->firstOrFail();

        if ($hewan->slot_terisi >= $hewan->kapasitas_slot) {
            return back()->with('error', 'Pendaftaran gagal: Slot untuk hewan kurban ini sudah penuh.');
        }

        // Tambahkan Jemaah Offline (user_id = null)
        Jemaah::create([
            'user_id' => null,
            'masjid_id' => $masjid->id,
            'hewan_kurban_id' => $hewan->id,
            'nama_jemaah' => $request->nama_jemaah,
            'total_saldo' => 0,
            'status' => 'Belum Mulai',
        ]);

        $hewan->increment('slot_terisi');

        return back()->with('success', 'Pendaftaran Jemaah (Offline) berhasil ditambahkan.');
    }
}

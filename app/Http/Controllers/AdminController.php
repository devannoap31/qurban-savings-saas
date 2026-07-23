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
        $totalSaldoTerkumpul = $jemaahs->sum('total_saldo');
        
        return view('admin.dashboard', compact(
            'masjid', 
            'hewanKurbans', 
            'jemaahs', 
            'setorans', 
            'pengeluarans',
            'totalSaldoTerkumpul'
        ));
    }
}

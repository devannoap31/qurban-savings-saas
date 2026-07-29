<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Jemaah;
use App\Models\Setoran;
use App\Models\Pengeluaran;

class JemaahController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        // Jemaah login dan melihat tabungannya di berbagai masjid
        $jemaahs = Jemaah::with(['masjid.rekenings', 'hewanKurban'])->where('user_id', $user->id)->get();
        
        if ($jemaahs->isEmpty()) {
            return "Anda belum terdaftar dalam tabungan kurban di masjid manapun.";
        }

        $jemaahIds = $jemaahs->pluck('id');
        $hewanKurbanIds = $jemaahs->pluck('hewan_kurban_id');

        $setorans = Setoran::with('masjid')->whereIn('jemaah_id', $jemaahIds)->orderBy('tanggal_setor', 'desc')->get();
        
        // Transparansi pengeluaran terkait hewan kurban yang dipilih jemaah
        $pengeluarans = Pengeluaran::with(['masjid', 'hewanKurban'])
                                   ->whereIn('hewan_kurban_id', $hewanKurbanIds)
                                   ->orderBy('tanggal', 'desc')
                                   ->get();
                                   
        return view('jemaah.dashboard', compact('jemaahs', 'setorans', 'pengeluarans'));
    }

    public function cetakLaporan($id)
    {
        $user = Auth::user();
        
        // Pastikan jemaah hanya bisa mencetak laporan miliknya sendiri
        $jemaah = Jemaah::with(['masjid', 'hewanKurban'])->where('id', $id)->where('user_id', $user->id)->firstOrFail();
        
        $setorans = Setoran::where('jemaah_id', $jemaah->id)->orderBy('tanggal_setor', 'asc')->get();
        
        $pengeluarans = Pengeluaran::where('hewan_kurban_id', $jemaah->hewan_kurban_id)->orderBy('tanggal', 'asc')->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('jemaah.laporan-pdf', compact('jemaah', 'setorans', 'pengeluarans'));
        
        return $pdf->download('laporan-tabungan-kurban-' . $jemaah->id . '.pdf');
    }
}

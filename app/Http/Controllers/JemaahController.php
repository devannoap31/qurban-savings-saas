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
        
        // Jemaah login dan melihat tabungannya
        $jemaah = Jemaah::with(['masjid', 'hewanKurban'])->where('user_id', $user->id)->first();
        
        if (!$jemaah) {
            return "Anda belum terdaftar dalam tabungan kurban di masjid manapun.";
        }

        $setorans = Setoran::where('jemaah_id', $jemaah->id)->orderBy('tanggal_setor', 'desc')->get();
        
        // Transparansi pengeluaran terkait hewan kurban yang dipilih jemaah
        $pengeluarans = Pengeluaran::where('hewan_kurban_id', $jemaah->hewan_kurban_id)
                                   ->orderBy('tanggal', 'desc')
                                   ->get();
                                   
        return view('jemaah.dashboard', compact('jemaah', 'setorans', 'pengeluarans'));
    }
}

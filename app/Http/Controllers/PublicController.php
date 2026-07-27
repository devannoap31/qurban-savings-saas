<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Masjid;
use App\Models\HewanKurban;

class PublicController extends Controller
{
    public function index(Request $request)
    {
        return view('public.landing');
    }

    public function masjids(Request $request)
    {
        $search = $request->input('q');
        
        $masjids = Masjid::with('hewanKurbans');
        
        if ($search) {
            $masjids = $masjids->where('name', 'like', "%{$search}%")
                               ->orWhere('city', 'like', "%{$search}%");
        }
        
        // Paginate 10 per page
        $masjids = $masjids->paginate(10);
        
        // Menambahkan ketersediaan slot untuk ditampilkan
        foreach ($masjids as $masjid) {
            $totalSedia = 0;
            $totalTerisi = 0;
            foreach ($masjid->hewanKurbans as $hewan) {
                $totalSedia += $hewan->kapasitas_slot;
                $totalTerisi += $hewan->slot_terisi;
            }
            $masjid->sisa_slot = $totalSedia - $totalTerisi;
        }

        return view('public.masjid-list', compact('masjids', 'search'));
    }

    public function showMasjid($id)
    {
        $masjid = Masjid::with(['hewanKurbans', 'rekenings'])->findOrFail($id);
        return view('public.masjid-show', compact('masjid'));
    }

    public function daftarJemaah($id)
    {
        $masjid = Masjid::with(['hewanKurbans', 'rekenings'])->findOrFail($id);
        return view('public.daftar-jemaah', compact('masjid'));
    }

    public function storeJemaah(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'hewan_kurban_id' => 'required|exists:hewan_kurbans,id'
        ]);

        $masjid = Masjid::findOrFail($id);
        $hewanKurban = HewanKurban::where('id', $request->hewan_kurban_id)->where('masjid_id', $masjid->id)->firstOrFail();

        // Check if there's still slot
        if ($hewanKurban->slot_terisi >= $hewanKurban->kapasitas_slot) {
            return back()->with('error', 'Maaf, slot untuk hewan kurban ini sudah penuh.')->withInput();
        }

        // Create User
        $user = \App\Models\User::create([
            'name' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'jemaah',
        ]);

        // Create Jemaah profile
        \App\Models\Jemaah::create([
            'user_id' => $user->id,
            'masjid_id' => $masjid->id,
            'hewan_kurban_id' => $hewanKurban->id,
            'nama_jemaah' => $request->nama_lengkap,
            'total_saldo' => 0,
            'status' => 'Belum Mulai'
        ]);

        // Update slot
        $hewanKurban->slot_terisi += 1;
        $hewanKurban->save();

        // Login user
        \Illuminate\Support\Facades\Auth::login($user);

        return redirect()->route('jemaah.dashboard')->with('success', 'Pendaftaran berhasil. Selamat datang di Sylvan Kurban.');
    }

    public function mitra()
    {
        return view('admin.landing');
    }

    public function register()
    {
        return view('admin.register');
    }

    public function tentang()
    {
        return view('public.pages.tentang');
    }

    public function panduan()
    {
        return view('public.pages.panduan');
    }

    public function bantuan()
    {
        return view('public.pages.bantuan');
    }

    public function privasi()
    {
        return view('public.pages.privasi');
    }

    public function syarat()
    {
        return view('public.pages.syarat');
    }
}

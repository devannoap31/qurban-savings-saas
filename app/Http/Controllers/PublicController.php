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

    public function mitra()
    {
        return view('admin.landing');
    }

    public function register()
    {
        return view('admin.register');
    }
}

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
        
        $masjids = Masjid::with('hewanKurbans')->whereHas('admin', function($query) {
            $query->where('status', 'active');
        });
        
        if ($search) {
            $masjids = $masjids->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
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
        $masjid = Masjid::with(['hewanKurbans', 'rekenings'])->whereHas('admin', function($q) {
            $q->where('status', 'active');
        })->findOrFail($id);
        return view('public.masjid-show', compact('masjid'));
    }

    public function daftarJemaah($id)
    {
        $masjid = Masjid::with(['hewanKurbans', 'rekenings'])->whereHas('admin', function($q) {
            $q->where('status', 'active');
        })->findOrFail($id);
        return view('public.daftar-jemaah', compact('masjid'));
    }

    public function storeJemaah(Request $request, $id)
    {
        $isLoggedIn = \Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->role === 'jemaah';

        if (!$isLoggedIn) {
            $request->validate([
                'nama_lengkap' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'hewan_kurban_id' => 'required|exists:hewan_kurbans,id'
            ]);
        } else {
            $request->validate([
                'hewan_kurban_id' => 'required|exists:hewan_kurbans,id'
            ]);
        }

        $masjid = Masjid::findOrFail($id);
        $hewanKurban = HewanKurban::where('id', $request->hewan_kurban_id)->where('masjid_id', $masjid->id)->firstOrFail();

        // Check if there's still slot
        if ($hewanKurban->slot_terisi >= $hewanKurban->kapasitas_slot) {
            return back()->with('error', 'Maaf, slot untuk hewan kurban ini sudah penuh.')->withInput();
        }

        if (!$isLoggedIn) {
            // Create User
            $user = \App\Models\User::create([
                'name' => $request->nama_lengkap,
                'email' => $request->email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->password),
                'role' => 'jemaah',
            ]);
            
            $namaJemaah = $request->nama_lengkap;
        } else {
            $user = \Illuminate\Support\Facades\Auth::user();
            $namaJemaah = $user->name;
        }

        // Create Jemaah profile
        \App\Models\Jemaah::create([
            'user_id' => $user->id,
            'masjid_id' => $masjid->id,
            'hewan_kurban_id' => $hewanKurban->id,
            'nama_jemaah' => $namaJemaah,
            'total_saldo' => 0,
            'status' => 'Belum Mulai'
        ]);

        // Update slot
        $hewanKurban->slot_terisi += 1;
        $hewanKurban->save();

        if (!$isLoggedIn) {
            // Login user
            \Illuminate\Support\Facades\Auth::login($user);
            event(new \Illuminate\Auth\Events\Registered($user));
            return redirect()->route('jemaah.dashboard')->with('success', 'Pendaftaran berhasil. Silakan cek email Anda untuk verifikasi.');
        }

        return redirect()->route('jemaah.dashboard')->with('success', 'Berhasil menambahkan tabungan kurban baru!');
    }

    public function mitra()
    {
        return view('admin.landing');
    }

    public function register()
    {
        return view('admin.register');
    }

    public function storeMitra(Request $request)
    {
        $request->validate([
            'nama_pengurus' => 'required|string|max:255',
            'nama_masjid' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.email' => 'Format email tidak valid atau domain email tidak ditemukan.',
            'email.unique' => 'Email ini sudah terdaftar sebelumnya.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
        ]);

        $admin = \App\Models\User::create([
            'name' => $request->nama_pengurus,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'role' => 'admin',
            'status' => 'pending'
        ]);

        \App\Models\Masjid::create([
            'admin_id' => $admin->id,
            'name' => $request->nama_masjid,
            'address' => $request->alamat,
        ]);

        event(new \Illuminate\Auth\Events\Registered($admin));
        
        \Illuminate\Support\Facades\Auth::login($admin);

        return redirect()->route('verification.notice');
    }

    public function cancelRegistration()
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        
        // Only allow cancel if user is authenticated and hasn't verified email
        if ($user && !$user->hasVerifiedEmail()) {
            if ($user->role === 'admin') {
                // Force delete masjid (if soft deletes, or just delete)
                \App\Models\Masjid::where('admin_id', $user->id)->forceDelete();
                
                // Force delete user
                $user->forceDelete();
                
                \Illuminate\Support\Facades\Auth::logout();
                
                return redirect()->route('mitra.register')->with('success', 'Pendaftaran sebelumnya dibatalkan. Silakan daftar ulang dengan email baru.');
            } elseif ($user->role === 'jemaah') {
                $jemaah = \App\Models\Jemaah::where('user_id', $user->id)->first();
                $masjidId = $jemaah ? $jemaah->masjid_id : null;
                $hewanId = $jemaah ? $jemaah->hewan_kurban_id : null;
                
                if ($hewanId) {
                    $hewan = \App\Models\HewanKurban::find($hewanId);
                    if ($hewan) {
                        $hewan->slot_terisi -= 1;
                        $hewan->save();
                    }
                }
                
                if ($jemaah) {
                    $jemaah->forceDelete();
                }
                
                $user->forceDelete();
                \Illuminate\Support\Facades\Auth::logout();
                
                if ($masjidId) {
                    return redirect()->route('masjids.daftar', $masjidId)->with('success', 'Pendaftaran sebelumnya dibatalkan. Silakan daftar ulang.');
                }
                return redirect('/')->with('success', 'Pendaftaran dibatalkan.');
            }
        }
        
        if ($user && $user->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/jemaah/dashboard');
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

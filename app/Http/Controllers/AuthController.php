<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login', ['is_mitra' => false, 'is_superadmin' => false]);
    }

    public function mitraLogin()
    {
        return view('auth.login', ['is_mitra' => true, 'is_superadmin' => false]);
    }

    public function superadminLogin()
    {
        return view('auth.login', ['is_mitra' => false, 'is_superadmin' => true]);
    }

    public function authenticateJemaah(Request $request)
    {
        return $this->processLogin($request, 'jemaah', route('jemaah.dashboard'));
    }

    public function authenticateMitra(Request $request)
    {
        return $this->processLogin($request, 'admin', route('admin.dashboard'));
    }

    public function authenticateSuperadmin(Request $request)
    {
        return $this->processLogin($request, 'superadmin', route('superadmin.dashboard'));
    }

    private function processLogin(Request $request, $expectedRole, $redirectRoute)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === $expectedRole) {
                $request->session()->regenerate();
                return redirect()->intended($redirectRoute);
            }
            
            // Wrong role for this login page
            Auth::logout();
            return back()->withErrors([
                'email' => 'Role akun Anda tidak diizinkan masuk melalui halaman ini.',
            ])->onlyInput('email');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Masjid;

class SuperadminController extends Controller
{
    public function index()
    {
        $admins = User::where('role', 'admin')->with('masjid')->get();
        $totalMasjid = Masjid::count();
        $totalJemaah = \App\Models\Jemaah::count();
        
        return view('superadmin.dashboard', compact('admins', 'totalMasjid', 'totalJemaah'));
    }
}

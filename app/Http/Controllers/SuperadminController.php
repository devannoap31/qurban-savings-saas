<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Masjid;

class SuperadminController extends Controller
{
    public function index(Request $request)
    {
        $pending_admins = User::where('role', 'admin')->where('status', 'pending')->with('masjid')->get();
        
        $query = User::select('users.*')
            ->where('users.role', 'admin')
            ->whereIn('users.status', ['active', 'suspended'])
            ->leftJoin('masjids', 'users.id', '=', 'masjids.admin_id')
            ->with('masjid');

        // Filter
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('users.status', $request->status);
        }

        // Search
        if ($request->has('q') && $request->q) {
            $searchTerm = '%' . $request->q . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('users.name', 'like', $searchTerm)
                  ->orWhere('users.email', 'like', $searchTerm)
                  ->orWhere('masjids.name', 'like', $searchTerm);
            });
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at');
        $order = $request->get('order', 'desc');

        if ($sortBy === 'name' || $sortBy === 'email') {
            $query->orderBy('users.' . $sortBy, $order);
        } elseif ($sortBy === 'masjid') {
            $query->orderBy('masjids.name', $order);
        } else {
            $query->orderBy('users.created_at', 'desc');
        }

        $perPage = $request->get('per_page', 5);
        $active_admins = $query->paginate($perPage)->appends($request->all());

        $totalMasjid = \App\Models\Masjid::count();
        $totalJemaah = \App\Models\Jemaah::count();
        
        return view('superadmin.dashboard', compact('pending_admins', 'active_admins', 'totalMasjid', 'totalJemaah'));
    }

    public function updateStatus($id, Request $request)
    {
        $user = User::findOrFail($id);
        $request->validate(['status' => 'required|in:active,suspended']);
        
        $user->status = $request->status;
        $user->save();

        return back()->with('success', 'Status pengurus berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Soft delete the user (will be archived)
        $user->delete();

        return back()->with('success', 'Akun pengurus berhasil dihapus dan diarsipkan.');
    }

    public function profil()
    {
        $user = auth()->user();
        return view('superadmin.profil', compact('user'));
    }

    public function arsip(Request $request)
    {
        $query = User::onlyTrashed()->where('role', 'admin')->with('masjid');

        if ($request->has('q') && $request->q) {
            $searchTerm = '%' . $request->q . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                  ->orWhere('email', 'like', $searchTerm);
            });
        }

        $archived_admins = $query->latest('deleted_at')->paginate(10)->appends($request->all());

        return view('superadmin.arsip', compact('archived_admins'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return back()->with('success', 'Akun takmir berhasil dipulihkan dari arsip.');
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->filled('password')) {
            $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}

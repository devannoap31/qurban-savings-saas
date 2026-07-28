@extends('layouts.dashboard-superadmin')

@section('title', 'Superadmin - Sylvan Kurban')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="mb-10 animate-hero">
        <span class="inline-block px-3 py-1 bg-[#e3e8e0] text-[var(--color-accent)] text-xs font-mono rounded-full mb-3">PANEL PUSAT</span>
        <h1 class="text-4xl font-display font-medium text-[var(--color-secondary)]">Dashboard Superadmin</h1>
        <p class="text-[var(--color-text-secondary)] font-body mt-2">Mengelola seluruh mitra masjid yang terdaftar dalam sistem Sylvan Kurban.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        <x-card class="animate-card border border-[var(--color-border)] !bg-[var(--color-secondary)] !text-[var(--color-primary)]">
            <p class="text-sm font-mono font-semibold text-gray-300 mb-2 uppercase tracking-wider">Total Mitra Masjid</p>
            <p class="text-5xl font-display font-medium text-[var(--color-primary)]">{{ $totalMasjid }}</p>
        </x-card>
        
        <x-card class="animate-card border border-[var(--color-border)]">
            <p class="text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2 uppercase tracking-wider">Total Jemaah Sistem</p>
            <p class="text-5xl font-display font-medium text-[var(--color-secondary)]">{{ $totalJemaah }}</p>
        </x-card>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-[4px] text-sm font-mono border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if($pending_admins->count() > 0)
    <h2 class="text-2xl font-display font-medium text-yellow-600 mb-6 animate-hero">Menunggu Persetujuan</h2>
    
    <x-card class="p-0 overflow-hidden animate-card mb-12 border-yellow-200">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-yellow-50 border-b border-yellow-100">
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-yellow-700 tracking-wider">NAMA TAKMIR</th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-yellow-700 tracking-wider">EMAIL</th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-yellow-700 tracking-wider">MASJID KELOLAAN</th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-yellow-700 tracking-wider">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-yellow-100 font-body">
                    @foreach($pending_admins as $admin)
                    <tr class="hover:bg-yellow-50/50 transition">
                        <td class="py-5 px-6 font-display font-medium text-gray-800">{{ $admin->name }}</td>
                        <td class="py-5 px-6 text-sm text-gray-600">{{ $admin->email }}</td>
                        <td class="py-5 px-6 text-sm font-bold text-gray-800">{{ $admin->masjid->name ?? 'Belum Membuat Masjid' }}</td>
                        <td class="py-5 px-6 text-sm flex gap-4">
                            <form action="{{ route('superadmin.status', $admin->id) }}" method="POST">
                                @csrf @method('PUT')
                                <input type="hidden" name="status" value="active">
                                <button type="submit" class="font-mono text-green-600 font-semibold hover:underline">SETUJUI</button>
                            </form>
                            <form action="{{ route('superadmin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Tolak dan hapus data takmir ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="font-mono text-red-600 font-semibold hover:underline">TOLAK</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>
    @endif

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 animate-hero gap-4">
        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)]">Daftar Takmir (Mitra)</h2>
        
        <form x-data="{ search: '{{ request('q') }}' }" class="flex flex-wrap items-center gap-3">
            <div class="relative">
                <input type="text" name="q" x-model="search" @input.debounce.500ms="$el.form.submit()" placeholder="Cari nama, email, masjid..." class="pl-9 pr-4 py-2 border border-gray-300 rounded-md text-sm focus:outline-none focus:ring-1 focus:ring-[var(--color-accent)] w-full md:w-64 font-body bg-white shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <select name="status" onchange="this.form.submit()" class="border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--color-accent)] font-body bg-white shadow-sm">
                <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
            </select>
            <select name="per_page" onchange="this.form.submit()" class="border border-gray-300 rounded-md py-2 px-3 text-sm focus:outline-none focus:ring-1 focus:ring-[var(--color-accent)] font-body bg-white">
                <option value="5" {{ request('per_page') == '5' ? 'selected' : '' }}>5 baris</option>
                <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10 baris</option>
                <option value="25" {{ request('per_page') == '25' ? 'selected' : '' }}>25 baris</option>
            </select>
            @if(request('sort_by')) <input type="hidden" name="sort_by" value="{{ request('sort_by') }}"> @endif
            @if(request('order')) <input type="hidden" name="order" value="{{ request('order') }}"> @endif
        </form>
    </div>
    
    <x-card class="p-0 overflow-hidden animate-card">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse" x-data="{ openDropdown: null }">
                <thead>
                    <tr class="bg-[#e3e8e0] border-b border-[var(--color-border)]">
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">
                            <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'name', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-1 hover:text-[var(--color-secondary)]">
                                NAMA TAKMIR
                                @if(request('sort_by') === 'name')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ request('order') === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" /></svg>
                                @endif
                            </a>
                        </th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">
                            <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'email', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-1 hover:text-[var(--color-secondary)]">
                                EMAIL
                                @if(request('sort_by') === 'email')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ request('order') === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" /></svg>
                                @endif
                            </a>
                        </th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">
                            <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'masjid', 'order' => request('order') === 'asc' ? 'desc' : 'asc']) }}" class="flex items-center gap-1 hover:text-[var(--color-secondary)]">
                                MASJID KELOLAAN
                                @if(request('sort_by') === 'masjid')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ request('order') === 'asc' ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7' }}" /></svg>
                                @endif
                            </a>
                        </th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">STATUS</th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--color-border)] font-body">
                    @forelse($active_admins as $admin)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-5 px-6 font-display font-medium text-[var(--color-secondary)]">{{ $admin->name }}</td>
                        <td class="py-5 px-6 text-sm text-[var(--color-text-secondary)]">{{ $admin->email }}</td>
                        <td class="py-5 px-6 text-sm font-bold text-[var(--color-secondary)]">{{ $admin->masjid->name ?? 'Belum Membuat Masjid' }}</td>
                        <td class="py-5 px-6 text-sm">
                            @if($admin->status == 'active')
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-md text-xs font-mono">Aktif</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded-md text-xs font-mono">Suspended</span>
                            @endif
                        </td>
                        <td class="py-5 px-6 text-sm relative">
                            <button @click="openDropdown === {{ $admin->id }} ? openDropdown = null : openDropdown = {{ $admin->id }}" @click.outside="openDropdown = null" class="font-mono text-[var(--color-accent)] font-semibold flex items-center gap-1 hover:text-[var(--color-secondary)]">
                                AKSI
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </button>
                            
                            <div x-show="openDropdown === {{ $admin->id }}" style="display: none;" class="absolute right-6 top-10 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-10 py-1">
                                @if($admin->status == 'active')
                                <form action="{{ route('superadmin.status', $admin->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="suspended">
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-yellow-600 hover:bg-yellow-50">Nonaktifkan (Suspend)</button>
                                </form>
                                @else
                                <form action="{{ route('superadmin.status', $admin->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="status" value="active">
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-green-600 hover:bg-green-50">Aktifkan Kembali</button>
                                </form>
                                @endif
                                
                                <form action="{{ route('superadmin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Hapus akun ini dan jadikan arsip? Seluruh data tetap akan tersimpan sebagai riwayat.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Hapus ke Arsip</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-10 text-center font-body text-[var(--color-text-secondary)]">Belum ada mitra admin terdaftar / tidak ada data yang cocok.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

    <div class="mt-6">
        {{ $active_admins->links() }}
    </div>

</div>
@endsection

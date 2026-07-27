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
        <x-card class="animate-card bg-[var(--color-secondary)] text-[var(--color-primary)]">
            <p class="text-sm font-mono font-semibold text-gray-400 mb-2 uppercase tracking-wider">Total Mitra Masjid</p>
            <p class="text-5xl font-display font-medium text-[var(--color-primary)]">{{ $totalMasjid }}</p>
        </x-card>
        
        <x-card class="animate-card border border-[var(--color-border)]">
            <p class="text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2 uppercase tracking-wider">Total Jemaah Sistem</p>
            <p class="text-5xl font-display font-medium text-[var(--color-secondary)]">{{ $totalJemaah }}</p>
        </x-card>
    </div>

    <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-6 animate-hero">Daftar Pengurus (Mitra)</h2>
    
    <x-card class="p-0 overflow-hidden animate-card">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[#e3e8e0] border-b border-[var(--color-border)]">
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">NAMA PENGURUS</th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">EMAIL</th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">MASJID KELOLAAN</th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[var(--color-border)] font-body">
                    @forelse($admins as $admin)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-5 px-6 font-display font-medium text-[var(--color-secondary)]">{{ $admin->name }}</td>
                        <td class="py-5 px-6 text-sm text-[var(--color-text-secondary)]">{{ $admin->email }}</td>
                        <td class="py-5 px-6 text-sm font-bold text-[var(--color-secondary)]">{{ $admin->masjid->name ?? 'Belum Membuat Masjid' }}</td>
                        <td class="py-5 px-6 text-sm flex gap-4">
                            <button class="font-mono text-[var(--color-accent)] font-semibold hover:underline" onclick="alert('Simulasi: Nonaktifkan mitra ini')">SUSPEND</button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="py-10 text-center font-body text-[var(--color-text-secondary)]">Belum ada mitra admin terdaftar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>

</div>
@endsection

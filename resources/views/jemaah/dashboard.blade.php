@extends('layouts.dashboard-jemaah')

@section('title', 'Dasbor Jemaah - Sylvan Kurban')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    @if(session('success'))
        <div class="bg-[var(--color-success)] text-white p-4 rounded-md mb-8 font-body animate-hero shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-10 animate-hero flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div>
            <h1 class="text-4xl font-display font-medium text-[var(--color-secondary)]">Dasbor Transparansi</h1>
            <p class="text-[var(--color-text-secondary)] font-body mt-2">Selamat datang, <span class="font-bold text-[var(--color-secondary)]">{{ Auth::user()->name }}</span></p>
        </div>
        <div class="bg-white px-5 py-3 rounded-lg border border-[var(--color-border)] shadow-sm inline-flex items-center">
            <span class="w-3 h-3 rounded-full bg-[var(--color-success)] mr-3 animate-pulse"></span>
            <span class="font-mono text-sm text-[var(--color-text-secondary)]">Status: <strong class="text-[var(--color-secondary)]">{{ $jemaah->status }}</strong></span>
        </div>
    </div>

    <!-- Info Masjid & Kurban -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <div class="lg:col-span-2">
            <x-card class="animate-card h-full bg-white border-[var(--color-border)]">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-xl font-display font-bold text-[var(--color-secondary)] mb-1">Target Tabungan</h2>
                        <p class="font-body text-sm text-[var(--color-text-secondary)]">
                            Pilihan: <span class="font-semibold text-[var(--color-text-primary)]">{{ $jemaah->hewanKurban->jenis_hewan }} ({{ $jemaah->hewanKurban->deskripsi }})</span>
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-mono text-[var(--color-text-secondary)] mb-1">Total Saldo</p>
                        <p class="text-2xl font-mono font-bold text-[var(--color-accent)]">Rp {{ number_format($jemaah->total_saldo, 0, ',', '.') }}</p>
                    </div>
                </div>

                @php
                    $target = $jemaah->hewanKurban->target_per_slot;
                    $persentase = $target > 0 ? min(100, round(($jemaah->total_saldo / $target) * 100)) : 0;
                @endphp

                <div class="mb-4">
                    <div class="flex justify-between text-sm font-mono mb-2">
                        <span class="text-[var(--color-text-secondary)]">Progres</span>
                        <span class="font-bold text-[var(--color-secondary)]">{{ $persentase }}% dari Rp {{ number_format($target, 0, ',', '.') }}</span>
                    </div>
                    <div class="w-full bg-[var(--color-background)] rounded-full h-3 overflow-hidden border border-[var(--color-border)]">
                        <div class="bg-[var(--color-accent)] h-full rounded-full transition-all duration-1000" style="width: {{ $persentase }}%"></div>
                    </div>
                </div>
                
                @if($persentase >= 100)
                    <div class="bg-[#cce8d6] text-[var(--color-secondary)] p-4 rounded-lg font-body text-sm mt-6 flex items-start">
                        <svg class="w-5 h-5 text-[var(--color-accent)] mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Alhamdulillah, tabungan kurban Anda telah mencapai target! Panitia akan segera mengonfirmasi persiapan hewan kurban Anda.
                    </div>
                @else
                    <p class="text-sm font-body text-[var(--color-text-secondary)] italic mt-4">
                        Kekurangan: Rp {{ number_format($target - $jemaah->total_saldo, 0, ',', '.') }}
                    </p>
                @endif
            </x-card>
        </div>

        <div class="lg:col-span-1">
            <x-card class="animate-card h-full bg-[var(--color-secondary)] text-[var(--color-primary)] border-none">
                <h3 class="font-display font-bold text-lg mb-4 text-[#cce8d6]">Masjid Pilihan</h3>
                <h4 class="text-2xl font-display font-medium mb-2">{{ $jemaah->masjid->name }}</h4>
                <p class="font-body text-sm text-gray-300 mb-6 flex items-start">
                    <svg class="w-4 h-4 mr-2 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $jemaah->masjid->address }}, {{ $jemaah->masjid->city }}
                </p>
                <div class="pt-6 border-t border-[#1a3423]">
                    <p class="font-body text-sm text-gray-300 mb-4">Untuk melakukan setoran, silakan transfer langsung ke rekening resmi masjid dan konfirmasikan ke takmir.</p>
                    <x-button variant="primary" class="w-full justify-center bg-[var(--color-primary)] text-[var(--color-secondary)] hover:bg-[#e3e8e0]" onclick="alert('Ini akan memunculkan popup informasi rekening masjid.')">Info Rekening</x-button>
                </div>
            </x-card>
        </div>
    </div>

    <!-- Riwayat & Transparansi -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Riwayat Setoran -->
        <div class="animate-card">
            <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-6">Riwayat Setoran Anda</h2>
            <x-card class="p-0 overflow-hidden bg-white border-[var(--color-border)]">
                <ul class="divide-y divide-[var(--color-border)]">
                    @forelse($setorans as $setoran)
                        <li class="p-5 flex justify-between items-center hover:bg-gray-50 transition">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-[#e3e8e0] text-[var(--color-accent)] flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                                </div>
                                <div>
                                    <p class="font-display font-medium text-[var(--color-secondary)]">Setoran Tabungan</p>
                                    <p class="text-xs font-mono text-[var(--color-text-secondary)] mt-1">{{ \Carbon\Carbon::parse($setoran->tanggal_setor)->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                            <span class="font-mono font-bold text-[var(--color-success)]">+ Rp {{ number_format($setoran->nominal, 0, ',', '.') }}</span>
                        </li>
                    @empty
                        <li class="p-10 text-center">
                            <p class="font-body text-[var(--color-text-secondary)]">Belum ada riwayat setoran.</p>
                        </li>
                    @endforelse
                </ul>
            </x-card>
        </div>

        <!-- Transparansi Pengeluaran -->
        <div class="animate-card">
            <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-6">Transparansi Dana Panitia</h2>
            <x-card class="p-0 overflow-hidden bg-white border-[var(--color-border)]">
                <div class="p-5 bg-gray-50 border-b border-[var(--color-border)]">
                    <p class="font-body text-sm text-[var(--color-text-secondary)]">Laporan pengeluaran panitia masjid untuk hewan: <strong>{{ $jemaah->hewanKurban->deskripsi }}</strong></p>
                </div>
                <ul class="divide-y divide-[var(--color-border)]">
                    @forelse($pengeluarans as $pengeluaran)
                        <li class="p-5 flex justify-between items-center hover:bg-gray-50 transition">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-red-50 text-[var(--color-error)] flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path></svg>
                                </div>
                                <div>
                                    <p class="font-display font-medium text-[var(--color-secondary)]">{{ $pengeluaran->nama_pengeluaran }}</p>
                                    <p class="text-xs font-mono text-[var(--color-text-secondary)] mt-1">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->translatedFormat('d F Y') }}</p>
                                </div>
                            </div>
                            <span class="font-mono font-bold text-[var(--color-error)]">- Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}</span>
                        </li>
                    @empty
                        <li class="p-10 text-center">
                            <p class="font-body text-[var(--color-text-secondary)]">Panitia belum mencatat pengeluaran apapun.</p>
                        </li>
                    @endforelse
                </ul>
            </x-card>
        </div>
    </div>
</div>
@endsection

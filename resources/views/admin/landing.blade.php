@extends('layouts.app')

@section('title', 'Mitra Masjid - Sylvan Kurban')

@section('content')
<div class="bg-[var(--color-secondary)] text-[var(--color-primary)] py-24 border-b border-[var(--color-secondary)] relative overflow-hidden">
    <!-- Abstract nature shape -->
    <div class="absolute top-0 right-0 w-1/2 h-full bg-[var(--color-accent)] opacity-20 -skew-x-12 transform origin-top-right"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-hero">
        <div class="max-w-3xl">
            <span class="inline-block px-3 py-1 bg-[var(--color-accent)] text-[var(--color-primary)] text-xs font-mono rounded-full mb-6">B2B SOLUTION</span>
            <h1 class="text-4xl md:text-6xl font-display font-medium mb-6 leading-tight">
                Digitalisasi <br><span class="italic font-body">Manajemen Kurban</span>
            </h1>
            <p class="text-xl font-body text-gray-300 mb-10 leading-relaxed max-w-2xl">
                Tingkatkan kepercayaan jemaah dengan sistem tabungan kurban yang transparan, mudah dilacak, dan terisolasi khusus untuk data masjid Anda.
            </p>
            <div class="flex gap-4">
                <a href="{{ route('mitra.register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-[var(--color-primary)] text-[var(--color-secondary)] rounded-full font-display font-bold text-sm transition-transform duration-300 hover:-translate-y-1 hover:shadow-lg">
                    Daftarkan Masjid
                </a>
                <a href="#fitur" class="inline-flex items-center justify-center px-8 py-4 border border-gray-500 text-gray-300 rounded-full font-display font-medium text-sm hover:bg-gray-800 transition-colors">
                    Pelajari Fitur
                </a>
            </div>
        </div>
    </div>
</div>

<div id="fitur" class="py-24 bg-[var(--color-background)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20 animate-hero">
            <h2 class="text-3xl font-display font-medium text-[var(--color-secondary)] mb-4">Fitur Unggulan</h2>
            <p class="font-body text-[var(--color-text-secondary)] text-lg max-w-2xl mx-auto">Kami memahami betapa rumitnya mencatat iuran puluhan jemaah. Sylvan hadir untuk menyederhanakannya.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <x-card class="animate-card bg-white">
                <div class="w-12 h-12 bg-[#e3e8e0] rounded-full flex items-center justify-center mb-6">
                    <span class="text-xl">📊</span>
                </div>
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-3">Isolasi Data Aman</h3>
                <p class="font-body text-[var(--color-text-secondary)] text-sm">Arsitektur Multi-Tenant memastikan data jemaah, hewan, dan keuangan masjid Anda tidak bercampur dengan masjid lain.</p>
            </x-card>
            
            <x-card class="animate-card bg-white">
                <div class="w-12 h-12 bg-[#e3e8e0] rounded-full flex items-center justify-center mb-6">
                    <span class="text-xl">💰</span>
                </div>
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-3">Manajemen Slot</h3>
                <p class="font-body text-[var(--color-text-secondary)] text-sm">Atur kapasitas sapi atau kambing dengan mudah. Sistem otomatis mengkalkulasi harga per slot (termasuk biaya operasional).</p>
            </x-card>
            
            <x-card class="animate-card bg-white">
                <div class="w-12 h-12 bg-[#e3e8e0] rounded-full flex items-center justify-center mb-6">
                    <span class="text-xl">📝</span>
                </div>
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-3">Rekap Setoran</h3>
                <p class="font-body text-[var(--color-text-secondary)] text-sm">Catat setoran cicilan dari jemaah tanpa buku catatan manual. Total saldo terhitung otomatis secara realtime.</p>
            </x-card>

            <x-card class="animate-card bg-white">
                <div class="w-12 h-12 bg-[#e3e8e0] rounded-full flex items-center justify-center mb-6">
                    <span class="text-xl">🔍</span>
                </div>
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-3">Transparansi Dana</h3>
                <p class="font-body text-[var(--color-text-secondary)] text-sm">Input bukti pengeluaran panitia untuk pakan, pemotongan, dll. Jemaah bisa melihatnya langsung di dasbor mereka.</p>
            </x-card>
        </div>
    </div>
</div>
@endsection

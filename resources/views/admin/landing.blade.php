@extends('layouts.admin')

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
                <div class="w-12 h-12 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-3">Isolasi Data Aman</h3>
                <p class="font-body text-[var(--color-text-secondary)] text-sm">Arsitektur Multi-Tenant memastikan data jemaah, hewan, dan keuangan masjid Anda tidak bercampur dengan masjid lain.</p>
            </x-card>
            
            <x-card class="animate-card bg-white">
                <div class="w-12 h-12 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-3">Manajemen Slot</h3>
                <p class="font-body text-[var(--color-text-secondary)] text-sm">Atur kapasitas sapi atau kambing dengan mudah. Sistem otomatis mengkalkulasi harga per slot (termasuk biaya operasional).</p>
            </x-card>
            
            <x-card class="animate-card bg-white">
                <div class="w-12 h-12 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-3">Rekap Setoran</h3>
                <p class="font-body text-[var(--color-text-secondary)] text-sm">Catat setoran cicilan dari jemaah tanpa buku catatan manual. Total saldo terhitung otomatis secara realtime.</p>
            </x-card>

            <x-card class="animate-card bg-white">
                <div class="w-12 h-12 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-3">Transparansi Dana</h3>
                <p class="font-body text-[var(--color-text-secondary)] text-sm">Input bukti pengeluaran panitia untuk pakan, pemotongan, dll. Jemaah bisa melihatnya langsung di dasbor mereka.</p>
            </x-card>
        </div>
    </div>
</div>
@endsection

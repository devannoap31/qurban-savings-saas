@extends('layouts.app')

@section('title', 'Mitra Masjid - Tabungan Kurban')

@section('content')
<div class="bg-[var(--color-primary)] text-white py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-tight">Kelola Tabungan Kurban Masjid Anda Secara Profesional & Transparan</h1>
        <p class="text-lg md:text-xl text-blue-100 max-w-3xl mx-auto mb-10">Tinggalkan pencatatan manual yang rawan hilang. Bergabunglah dengan puluhan masjid lain menggunakan platform pencatatan kurban digital yang aman.</p>
        
        <a href="{{ route('mitra.register') }}" class="inline-block bg-white text-[var(--color-primary)] px-8 py-4 rounded-[4px] font-bold hover:bg-gray-50 transition">
            Gabung Menjadi Mitra &rarr;
        </a>
    </div>
</div>

<div class="py-20 bg-[var(--color-surface)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-[var(--color-on-surface)]">Kenapa Memilih Platform Kami?</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-[var(--color-tertiary)] border border-[var(--color-border)] p-8 rounded-[8px] text-center">
                <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center text-[var(--color-primary)] mb-6 shadow-sm border border-[var(--color-border)]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[var(--color-on-surface)] mb-4">Rekapitulasi Otomatis</h3>
                <p class="text-[var(--color-muted)] text-sm">Sistem otomatis menghitung persentase tabungan setiap jemaah. Laporan lengkap siap cetak dalam satu klik.</p>
            </div>
            
            <div class="bg-[var(--color-tertiary)] border border-[var(--color-border)] p-8 rounded-[8px] text-center">
                <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center text-[var(--color-success)] mb-6 shadow-sm border border-[var(--color-border)]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[var(--color-on-surface)] mb-4">Aman & Terisolasi</h3>
                <p class="text-[var(--color-muted)] text-sm">Menganut arsitektur Multi-Tenant yang menjamin data masjid Anda tidak akan pernah bercampur dengan data masjid lain.</p>
            </div>
            
            <div class="bg-[var(--color-tertiary)] border border-[var(--color-border)] p-8 rounded-[8px] text-center">
                <div class="w-16 h-16 mx-auto bg-white rounded-full flex items-center justify-center text-purple-600 mb-6 shadow-sm border border-[var(--color-border)]">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-[var(--color-on-surface)] mb-4">Tingkatkan Kepercayaan</h3>
                <p class="text-[var(--color-muted)] text-sm">Jemaah dapat memantau tabungannya sendiri secara real-time lewat Portal Publik, meningkatkan transparansi.</p>
            </div>
        </div>
    </div>
</div>
@endsection

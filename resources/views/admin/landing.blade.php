@extends('layouts.public-mitra')

@section('title', 'Mitra Masjid - Sylvan Kurban')

@section('content')
<div class="relative overflow-hidden pt-24 pb-32 border-b border-[var(--color-border)]">
    <!-- Background Images -->
    <div class="absolute inset-0 -z-10">
        <img src="{{ asset('images/hero-mitra.jpg') }}" alt="Mitra Masjid" class="w-full h-full object-cover">
        <!-- Overlay to ensure text readability -->
        <div class="absolute inset-0 bg-[var(--color-secondary)]/80 backdrop-blur-[2px]"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-hero text-[var(--color-primary)]">
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
            <x-card class="animate-card bg-[var(--color-surface)]">
                <div class="w-12 h-12 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-3">Isolasi Data Aman</h3>
                <p class="font-body text-[var(--color-text-secondary)] text-sm">Arsitektur Multi-Tenant memastikan data jemaah, hewan, dan keuangan masjid Anda tidak bercampur dengan masjid lain.</p>
            </x-card>
            
            <x-card class="animate-card bg-[var(--color-surface)]">
                <div class="w-12 h-12 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-3">Manajemen Slot</h3>
                <p class="font-body text-[var(--color-text-secondary)] text-sm">Atur kapasitas sapi atau kambing dengan mudah. Sistem otomatis mengkalkulasi harga per slot (termasuk biaya operasional).</p>
            </x-card>
            
            <x-card class="animate-card bg-[var(--color-surface)]">
                <div class="w-12 h-12 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-3">Rekap Setoran</h3>
                <p class="font-body text-[var(--color-text-secondary)] text-sm">Catat setoran cicilan dari jemaah tanpa buku catatan manual. Total saldo terhitung otomatis secara realtime.</p>
            </x-card>

            <x-card class="animate-card bg-[var(--color-surface)]">
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

<!-- Cara Bermitra Section -->
<div class="py-24 border-t border-[var(--color-border)] bg-[var(--color-surface)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-hero">
            <h2 class="text-3xl font-display font-medium text-[var(--color-secondary)] mb-4">Cara Mudah Bermitra</h2>
            <p class="font-body text-[var(--color-text-secondary)] text-lg max-w-2xl mx-auto">Tiga langkah praktis membawa manajemen kurban masjid Anda ke era digital.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center">
            <div class="animate-card">
                <div class="w-20 h-20 bg-[var(--color-background)] rounded-full flex items-center justify-center mx-auto mb-6 border border-[var(--color-border)] shadow-sm text-3xl font-display text-[var(--color-accent)] font-bold">1</div>
                <h3 class="text-xl font-display font-bold text-[var(--color-secondary)] mb-3">Daftarkan Masjid</h3>
                <p class="font-body text-[var(--color-text-secondary)]">Isi formulir pendaftaran singkat dengan data takmir dan informasi masjid yang valid.</p>
            </div>
            
            <div class="animate-card" style="animation-delay: 100ms;">
                <div class="w-20 h-20 bg-[var(--color-background)] rounded-full flex items-center justify-center mx-auto mb-6 border border-[var(--color-border)] shadow-sm text-3xl font-display text-[var(--color-accent)] font-bold">2</div>
                <h3 class="text-xl font-display font-bold text-[var(--color-secondary)] mb-3">Atur Slot Kurban</h3>
                <p class="font-body text-[var(--color-text-secondary)]">Tentukan jenis hewan kurban (Sapi/Kambing), spesifikasi, harga, dan target biaya di dasbor Anda.</p>
            </div>
            
            <div class="animate-card" style="animation-delay: 200ms;">
                <div class="w-20 h-20 bg-[var(--color-background)] rounded-full flex items-center justify-center mx-auto mb-6 border border-[var(--color-border)] shadow-sm text-3xl font-display text-[var(--color-accent)] font-bold">3</div>
                <h3 class="text-xl font-display font-bold text-[var(--color-secondary)] mb-3">Mulai Menerima Jemaah</h3>
                <p class="font-body text-[var(--color-text-secondary)]">Masjid Anda kini tampil di halaman pencarian, siap menerima setoran tabungan dari jemaah mana pun.</p>
            </div>
        </div>
    </div>
</div>

<!-- Impact Stats -->
<div class="bg-[var(--color-accent)] py-20 border-y border-[#1a3423]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 animate-hero">
            <h2 class="text-2xl md:text-3xl font-display font-medium text-[#cce8d6]">Dampak Nyata Digitalisasi Kurban</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center animate-hero">
            <div>
                <div class="text-4xl md:text-5xl font-display font-bold text-white mb-2">85%</div>
                <div class="font-body text-[#cce8d6] text-sm uppercase tracking-wider">Efisiensi Waktu Panitia</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-display font-bold text-white mb-2">3x</div>
                <div class="font-body text-[#cce8d6] text-sm uppercase tracking-wider">Pertumbuhan Jemaah Baru</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-display font-bold text-white mb-2">0</div>
                <div class="font-body text-[#cce8d6] text-sm uppercase tracking-wider">Selisih Perhitungan Uang</div>
            </div>
            <div>
                <div class="text-4xl md:text-5xl font-display font-bold text-white mb-2">24/7</div>
                <div class="font-body text-[#cce8d6] text-sm uppercase tracking-wider">Akses Pantauan Real-time</div>
            </div>
        </div>
    </div>
</div>

<!-- FAQ Mitra Section -->
<div class="bg-[var(--color-background)] py-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-hero">
            <h2 class="text-3xl font-display font-medium text-[var(--color-secondary)] mb-4">Tanya Jawab Takmir</h2>
            <p class="font-body text-[var(--color-text-secondary)] text-lg">Pertanyaan yang sering ditanyakan oleh pengurus masjid.</p>
        </div>
        
        <div class="space-y-4 animate-hero">
            <div class="bg-[var(--color-surface)] rounded-[8px] border border-[var(--color-border)] p-6 hover:border-[var(--color-accent)] transition-colors">
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-2">Apakah data jemaah masjid saya aman dan tidak bocor ke masjid lain?</h3>
                <p class="font-body text-[var(--color-text-secondary)]">Sangat aman. Sistem kami dirancang menggunakan arsitektur <em>Multi-Tenant</em>. Artinya, setiap data jemaah, slot kurban, dan setoran benar-benar diisolasi. Admin masjid lain tidak akan pernah bisa mengakses atau melihat data jemaah Anda.</p>
            </div>
            <div class="bg-[var(--color-surface)] rounded-[8px] border border-[var(--color-border)] p-6 hover:border-[var(--color-accent)] transition-colors">
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-2">Bagaimana cara uang setoran masuk?</h3>
                <p class="font-body text-[var(--color-text-secondary)]">Sistem ini murni sebagai pencatatan dan pengelolaan (buku besar digital). Jemaah akan tetap mentransfer dana secara langsung ke rekening resmi masjid Anda. Setelah itu, admin Anda hanya perlu memverifikasi dan menginput nominalnya di dasbor.</p>
            </div>
            <div class="bg-[var(--color-surface)] rounded-[8px] border border-[var(--color-border)] p-6 hover:border-[var(--color-accent)] transition-colors">
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-2">Apakah aplikasi ini berbayar?</h3>
                <p class="font-body text-[var(--color-text-secondary)]">Sylvan Kurban disediakan sebagai bentuk pengabdian untuk umat. Pengurus masjid dapat menggunakan layanan pencatatan ini secara gratis tanpa ada potongan dana kurban sepeser pun.</p>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-[var(--color-secondary)] py-20 border-t border-[var(--color-secondary)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-hero">
        <h2 class="text-3xl md:text-4xl font-display font-medium text-[var(--color-primary)] mb-6">Siap Mendigitalkan Manajemen Kurban Masjid Anda?</h2>
        <p class="font-body text-[#cce8d6] text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
            Bergabunglah dengan ekosistem Sylvan Kurban. Kurangi stres pencatatan manual dan tingkatkan kepercayaan dari transparansi dana umat.
        </p>
        <a href="{{ route('mitra.register') }}" class="inline-flex items-center justify-center px-8 py-4 bg-[var(--color-primary)] text-[var(--color-secondary)] rounded-full font-display font-bold text-sm transition-transform duration-300 hover:-translate-y-1 hover:shadow-lg">
            Daftarkan Masjid Sekarang
        </a>
    </div>
</div>

@endsection

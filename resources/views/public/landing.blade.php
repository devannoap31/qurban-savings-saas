@extends('layouts.public-jemaah')

@section('title', 'Sylvan Kurban - Tabungan Kurban')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden pt-24 pb-32">
    <!-- Background Images -->
    <div class="absolute inset-0 -z-10">
        <picture>
            <source media="(min-width: 768px)" srcset="{{ asset('images/hero_jemaah_dekstop.jpg') }}">
            <img src="{{ asset('images/hero_jamaah_mobile.webp') }}" alt="Tabungan Kurban" class="w-full h-full object-cover">
        </picture>
        <!-- Overlay to ensure text readability -->
        <div class="absolute inset-0 bg-[var(--color-secondary)]/70 md:bg-[var(--color-secondary)]/60 backdrop-blur-[2px]"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-hero">
        <h1 class="text-5xl md:text-7xl font-display font-medium text-[var(--color-primary)] mb-6 tracking-tight leading-tight">
            Niat Baik, <br><span class="italic font-body text-[#cce8d6]">Tumbuh Perlahan.</span>
        </h1>
        <p class="mt-4 text-xl text-gray-200 font-body max-w-2xl mx-auto mb-10 leading-relaxed">
            Sylvan Kurban membantu Anda menabung kurban dengan tenang, terencana, dan penuh transparansi. Temukan masjid terdekat dan mulai menabung hari ini.
        </p>
        
        <form action="{{ route('masjids.index') }}" method="GET" class="max-w-2xl mx-auto relative animate-hero">
            <div class="flex shadow-sm rounded-full overflow-hidden border border-[var(--color-border)] bg-[var(--color-surface)] items-center pr-2">
                <input type="text" name="q" placeholder="Cari nama masjid atau kota tempat tinggal Anda..." class="w-full px-8 py-5 text-[var(--color-text-primary)] focus:outline-none bg-transparent font-display text-lg">
                <button type="submit" class="bg-[var(--color-secondary)] text-[var(--color-primary)] w-14 h-14 rounded-full flex items-center justify-center hover:bg-[var(--color-accent)] transition shrink-0 shadow-sm mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Features / How it works -->
<div class="bg-[var(--color-surface)] py-24 border-y border-[var(--color-border)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16 animate-hero">
            <h2 class="text-3xl font-display font-medium text-[var(--color-secondary)] mb-4">Langkah Menuju Kurban</h2>
            <p class="font-body text-[var(--color-text-secondary)] text-lg">Tiga langkah mudah untuk mewujudkan niat Anda.</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <x-card class="text-center animate-card border-none bg-transparent shadow-none hover:shadow-none p-0">
                <div class="w-16 h-16 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-display">1</div>
                <h3 class="text-xl font-display font-bold text-[var(--color-secondary)] mb-3">Pilih Masjid</h3>
                <p class="font-body text-[var(--color-text-secondary)]">Cari masjid di sekitar Anda yang menyediakan program tabungan dan pilih slot hewan kurban yang tersedia.</p>
            </x-card>
            <x-card class="text-center animate-card border-none bg-transparent shadow-none hover:shadow-none p-0">
                <div class="w-16 h-16 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-display">2</div>
                <h3 class="text-xl font-display font-bold text-[var(--color-secondary)] mb-3">Menabung Berkala</h3>
                <p class="font-body text-[var(--color-text-secondary)]">Cicil pembayaran kurban Anda ke rekening takmir masjid dengan nominal fleksibel sesuai kemampuan.</p>
            </x-card>
            <x-card class="text-center animate-card border-none bg-transparent shadow-none hover:shadow-none p-0">
                <div class="w-16 h-16 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center mx-auto mb-6 text-2xl font-display">3</div>
                <h3 class="text-xl font-display font-bold text-[var(--color-secondary)] mb-3">Pantau Transparansi</h3>
                <p class="font-body text-[var(--color-text-secondary)]">Lihat progres tabungan dan rincian pengeluaran panitia secara langsung dari dasbor Anda.</p>
            </x-card>
        </div>
    </div>
</div>

<!-- Keunggulan Section -->
<div class="bg-[var(--color-background)] py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row items-center gap-16">
            <div class="w-full md:w-1/2 animate-hero">
                <span class="inline-block px-3 py-1 bg-[#e3e8e0] text-[var(--color-accent)] text-xs font-mono rounded-full mb-4">KENAPA SYLVAN?</span>
                <h2 class="text-3xl md:text-4xl font-display font-medium text-[var(--color-secondary)] mb-6 leading-tight">Beribadah dengan Pikiran yang Tenang</h2>
                <p class="font-body text-[var(--color-text-secondary)] text-lg mb-8 leading-relaxed">
                    Kami mendesain Sylvan Kurban untuk memberikan kepastian dan keamanan bagi Anda. Setiap rupiah yang Anda tabungkan dapat dilacak penggunaannya secara transparan.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-[var(--color-accent)] mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="font-body text-[var(--color-text-primary)]"><strong>100% Transparan:</strong> Lihat laporan pembelian hewan kurban langsung dari takmir masjid.</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-[var(--color-accent)] mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="font-body text-[var(--color-text-primary)]"><strong>Tanpa Potongan:</strong> Dana ditransfer langsung ke rekening masjid, tanpa biaya admin tambahan.</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-[var(--color-accent)] mr-3 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="font-body text-[var(--color-text-primary)]"><strong>Fleksibel:</strong> Atur sendiri target penyelesaian dan jumlah setoran sesuai dengan kemampuan.</span>
                    </li>
                </ul>
            </div>
            <div class="w-full md:w-1/2">
                <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-2xl p-8 shadow-sm transform rotate-1 hover:rotate-0 transition duration-500">
                    <div class="flex items-center justify-between mb-6 border-b border-[var(--color-border)] pb-4">
                        <div class="font-display font-bold text-[var(--color-secondary)]">Simulasi Tabungan</div>
                        <div class="text-xs font-mono text-[var(--color-text-secondary)]">Kambing Premium</div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center font-body text-sm">
                            <span class="text-[var(--color-text-secondary)]">Target Biaya</span>
                            <span class="font-bold text-[var(--color-text-primary)]">Rp 3.500.000</span>
                        </div>
                        <div class="flex justify-between items-center font-body text-sm">
                            <span class="text-[var(--color-text-secondary)]">Telah Terkumpul</span>
                            <span class="font-bold text-[var(--color-success)]">Rp 2.000.000</span>
                        </div>
                        <div class="w-full bg-[var(--color-background)] rounded-full h-2.5 mt-2 overflow-hidden border border-[var(--color-border)]">
                            <div class="bg-[var(--color-accent)] h-full rounded-full" style="width: 57%"></div>
                        </div>
                        <div class="text-right text-xs font-mono text-[var(--color-text-secondary)] mt-1">57% Tercapai</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CTA Section -->
<div class="bg-[var(--color-secondary)] py-20 border-t border-[var(--color-secondary)]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-hero">
        <h2 class="text-3xl md:text-4xl font-display font-medium text-[var(--color-primary)] mb-6">Mulai Tabungan Kurban Anda Hari Ini</h2>
        <p class="font-body text-[#cce8d6] text-lg mb-10 max-w-2xl mx-auto leading-relaxed">
            Jangan tunda niat baik Anda. Temukan masjid yang cocok dan mulai mencicil tabungan dengan langkah kecil yang sangat berarti.
        </p>
        <a href="{{ route('masjids.index') }}" class="inline-flex items-center justify-center px-8 py-4 bg-[var(--color-primary)] text-[var(--color-secondary)] rounded-full font-display font-bold text-sm transition-transform duration-300 hover:-translate-y-1 hover:shadow-lg">
            Cari Masjid Terdekat
        </a>
    </div>
</div>

@endsection

@extends('layouts.app')

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
        <div class="absolute inset-0 bg-white/40 md:bg-white/30 backdrop-blur-[1px]"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-hero">
        <h1 class="text-5xl md:text-7xl font-display font-medium text-[var(--color-secondary)] mb-6 tracking-tight leading-tight">
            Niat Baik, <br><span class="italic font-body text-[var(--color-accent)]">Tumbuh Perlahan.</span>
        </h1>
        <p class="mt-4 text-xl text-[var(--color-text-secondary)] font-body max-w-2xl mx-auto mb-10 leading-relaxed">
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


@endsection

@extends('layouts.app')

@section('title', 'Sylvan Kurban - Tabungan Kurban')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden pt-24 pb-32">
    <!-- Background element -->
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-gradient-to-b from-[#e3e8e0] to-transparent -z-10"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center animate-hero">
        <h1 class="text-5xl md:text-7xl font-display font-medium text-[var(--color-secondary)] mb-6 tracking-tight leading-tight">
            Niat Baik, <br><span class="italic font-body text-[var(--color-accent)]">Tumbuh Perlahan.</span>
        </h1>
        <p class="mt-4 text-xl text-[var(--color-text-secondary)] font-body max-w-2xl mx-auto mb-10 leading-relaxed">
            Sylvan Kurban membantu Anda menabung kurban dengan tenang, terencana, dan penuh transparansi. Temukan masjid terdekat dan mulai menabung hari ini.
        </p>
        
        <form action="{{ route('home') }}" method="GET" class="max-w-2xl mx-auto relative animate-hero">
            <div class="flex flex-col sm:flex-row shadow-sm rounded-full overflow-hidden border border-[var(--color-border)] bg-[var(--color-surface)]">
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama masjid atau kota tempat tinggal Anda..." class="w-full px-8 py-5 text-[var(--color-text-primary)] focus:outline-none bg-transparent font-display text-lg">
                <button type="submit" class="bg-[var(--color-secondary)] text-[var(--color-primary)] px-10 py-5 font-display font-medium hover:bg-[var(--color-accent)] transition sm:w-auto w-full">Temukan</button>
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

<!-- Search Results -->
<div class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if(isset($search))
        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-8 animate-hero">
            Hasil pencarian untuk: <span class="italic font-body">"{{ $search }}"</span>
        </h2>
    @else
        <h2 class="text-3xl font-display font-medium text-[var(--color-secondary)] mb-2 text-center animate-hero">Masjid Terdaftar</h2>
        <p class="font-body text-[var(--color-text-secondary)] text-center mb-12 animate-hero">Mitra sylvan yang siap memfasilitasi ibadah kurban Anda.</p>
    @endif

    @if($masjids->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($masjids as $masjid)
                <x-card class="animate-card flex flex-col h-full">
                    <div class="mb-4">
                        <span class="inline-block px-3 py-1 bg-[#e3e8e0] text-[var(--color-accent)] text-xs font-mono rounded-full mb-3">{{ $masjid->city }}</span>
                        <h3 class="text-xl font-display font-bold text-[var(--color-secondary)]">{{ $masjid->name }}</h3>
                        <p class="text-[var(--color-text-secondary)] font-body text-sm mt-2">{{ $masjid->address }}</p>
                    </div>
                    
                    <div class="mt-4 pt-4 border-t border-[var(--color-border)] flex-grow">
                        <h4 class="font-mono text-xs text-[var(--color-text-secondary)] uppercase tracking-wider font-semibold mb-3">Slot Kurban Tersedia:</h4>
                        @if($masjid->hewanKurbans && $masjid->hewanKurbans->count() > 0)
                            <ul class="space-y-3 font-body text-sm">
                                @foreach($masjid->hewanKurbans as $hewan)
                                    <li class="flex justify-between items-center">
                                        <span class="text-[var(--color-secondary)] font-medium">{{ $hewan->jenis_hewan }} ({{ $hewan->deskripsi }})</span>
                                        <span class="text-[var(--color-accent)] font-semibold">{{ $hewan->kapasitas_slot - $hewan->slot_terisi }} Sisa</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-[var(--color-text-secondary)] text-sm italic font-body">Belum ada data hewan kurban.</p>
                        @endif
                    </div>
                    
                    <div class="mt-6 pt-4">
                        <x-button variant="outline" class="w-full" onclick="alert('Ini adalah simulasi pendaftaran jemaah. Di sistem nyata, akan mengarah ke form registrasi Jemaah untuk masjid ini.')">
                            Daftar Tabungan
                        </x-button>
                    </div>
                </x-card>
            @endforeach
        </div>
    @else
        <div class="text-center py-16 bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] animate-hero">
            <p class="text-xl text-[var(--color-text-secondary)] font-body">Mohon maaf, tidak ada masjid yang sesuai dengan pencarian Anda.</p>
            <a href="{{ route('home') }}" class="text-[var(--color-accent)] font-medium mt-4 inline-block hover:underline font-display">Tampilkan semua masjid</a>
        </div>
    @endif
</div>
@endsection

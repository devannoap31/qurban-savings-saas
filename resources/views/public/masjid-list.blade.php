@extends('layouts.public-jemaah')

@section('title', 'Daftar Masjid - Sylvan Kurban')

@section('content')
<div class="relative overflow-hidden py-16 border-b border-[var(--color-border)]">
    <!-- Background Images -->
    <div class="absolute inset-0 -z-10">
        <picture>
            <source media="(min-width: 768px)" srcset="{{ asset('images/hero_jemaah_dekstop.jpg') }}">
            <img src="{{ asset('images/hero_jamaah_mobile.webp') }}" alt="Daftar Masjid" class="w-full h-full object-cover">
        </picture>
        <!-- Overlay to ensure text readability -->
        <div class="absolute inset-0 bg-[var(--color-secondary)]/80 backdrop-blur-[3px]"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col md:flex-row justify-between items-center gap-8 animate-hero">
            <div class="w-full md:w-1/2">
                <h1 class="text-3xl md:text-4xl font-display font-medium text-[var(--color-primary)] leading-tight mb-2">Daftar Masjid Mitra</h1>
                <p class="font-body text-[#cce8d6] text-lg">Temukan masjid terdekat untuk mulai menabung kurban Anda.</p>
            </div>
            
            <form action="{{ route('masjids.index') }}" method="GET" class="w-full md:w-1/2 lg:w-96 relative">
                <x-search-bar size="normal" placeholder="Cari nama atau kota..." :value="$search ?? ''" />
            </form>
        </div>
    </div>
</div>

<div class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    @if(isset($search))
        <h2 class="text-xl font-display font-medium text-[var(--color-secondary)] mb-8 animate-hero">
            Hasil pencarian untuk: <span class="italic font-body">"{{ $search }}"</span>
        </h2>
    @endif

    @if($masjids->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($masjids as $masjid)
                <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-2xl overflow-hidden hover:shadow-lg transition-all group flex flex-col h-full">
                    <a href="{{ route('masjids.show', $masjid->id) }}" class="aspect-video w-full bg-gray-200 overflow-hidden relative block">
                        @if($masjid->gambar)
                            <img src="{{ Str::startsWith($masjid->gambar, 'http') ? $masjid->gambar : Storage::url($masjid->gambar) }}" alt="{{ $masjid->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-[#e3e8e0] text-[var(--color-secondary)]">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 opacity-50">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                                </svg>
                            </div>
                        @endif
                    </a>
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            <span class="inline-block bg-[#e3e8e0] text-[var(--color-secondary)] px-3 py-1 rounded-full text-xs font-bold font-display tracking-wide uppercase">{{ $masjid->city }}</span>
                        </div>
                        <a href="{{ route('masjids.show', $masjid->id) }}" class="block">
                            <h3 class="text-xl font-display font-medium text-[var(--color-text-primary)] mb-2 hover:text-[var(--color-secondary)] transition">{{ $masjid->name }}</h3>
                        </a>
                        <p class="text-gray-500 font-body text-sm">{{ Str::limit($masjid->address, 60) }}</p>
                    
                        <div class="mt-auto pt-5 border-t border-[var(--color-border)]">
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
                        
                        <div class="mt-6">
                            <x-button variant="primary" class="w-full" href="{{ route('masjids.daftar', $masjid->id) }}">
                                Daftar Tabungan
                            </x-button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination Links -->
        <div class="mt-10 flex justify-center animate-hero">
            {{ $masjids->withQueryString()->links() }}
        </div>
    @else
        <div class="text-center py-16 bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] animate-hero">
            <p class="text-xl text-[var(--color-text-secondary)] font-body">Mohon maaf, tidak ada masjid yang sesuai dengan pencarian Anda.</p>
            <a href="{{ route('masjids.index') }}" class="text-[var(--color-accent)] font-medium mt-4 inline-block hover:underline font-display">Tampilkan semua masjid</a>
        </div>
    @endif
</div>
@endsection

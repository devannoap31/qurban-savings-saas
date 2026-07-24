@extends('layouts.app')

@section('title', 'Daftar Masjid - Sylvan Kurban')

@section('content')
<div class="bg-[var(--color-surface)] py-12 border-b border-[var(--color-border)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 animate-hero">
            <div>
                <h1 class="text-3xl font-display font-medium text-[var(--color-secondary)]">Daftar Masjid Mitra</h1>
                <p class="font-body text-[var(--color-text-secondary)] mt-2">Temukan masjid terdekat untuk mulai menabung kurban Anda.</p>
            </div>
            
            <form action="{{ route('masjids.index') }}" method="GET" class="w-full md:w-96 relative">
                <div class="flex shadow-sm rounded-full overflow-hidden border border-[var(--color-border)] bg-[var(--color-primary)] items-center pr-1.5 focus-within:ring-2 focus-within:ring-[var(--color-accent)] focus-within:border-transparent transition-all">
                    <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari nama atau kota..." class="w-full px-5 py-3 text-[var(--color-text-primary)] focus:outline-none bg-transparent font-display text-sm">
                    <button type="submit" class="bg-[var(--color-secondary)] text-[var(--color-primary)] w-9 h-9 rounded-full flex items-center justify-center hover:bg-[var(--color-accent)] transition shrink-0 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
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

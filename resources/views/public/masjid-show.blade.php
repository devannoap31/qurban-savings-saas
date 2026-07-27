@extends('layouts.public-jemaah')

@section('title', 'Detail Masjid - Sylvan Kurban')

@section('content')
<div class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Hero Section -->
    <div class="mb-12 text-center animate-hero">
        <h1 class="text-4xl md:text-5xl font-display font-medium text-[var(--color-secondary)] mb-4">{{ $masjid->name }}</h1>
        <p class="text-lg text-[var(--color-text-secondary)] font-body max-w-2xl mx-auto">
            <i class="fa-solid fa-location-dot mr-2"></i> {{ $masjid->address ?? 'Alamat belum dilengkapi' }}, {{ $masjid->city ?? '-' }}
        </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Kolom Kiri: Foto & Profil -->
        <div class="lg:col-span-1 space-y-8 animate-fade-in-up">
            <x-card class="bg-white border-[var(--color-border)] overflow-hidden p-0">
                @if($masjid->gambar)
                    <img src="{{ str_starts_with($masjid->gambar, 'http') ? $masjid->gambar : asset('storage/' . $masjid->gambar) }}" alt="{{ $masjid->name }}" class="w-full h-64 object-cover">
                @else
                    <div class="w-full h-64 bg-[#e3e8e0] flex items-center justify-center text-[var(--color-text-secondary)]">
                        <i class="fa-regular fa-image text-4xl mb-2"></i>
                        <span class="block mt-2 font-body">Belum ada foto</span>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="font-display font-bold text-xl text-[var(--color-secondary)] mb-3">Tentang Masjid</h3>
                    <p class="font-body text-[var(--color-text-primary)] whitespace-pre-line mb-6">
                        {{ $masjid->deskripsi ?? 'Masjid ini belum menambahkan deskripsi profil mereka. Namun, mereka siap menerima tabungan kurban Anda.' }}
                    </p>
                    
                    @if($masjid->kontak_person)
                    <div class="flex items-center text-[var(--color-text-secondary)] font-body">
                        <i class="fa-brands fa-whatsapp text-[var(--color-accent)] text-xl mr-3"></i>
                        <span>{{ $masjid->kontak_person }}</span>
                    </div>
                    @endif
                </div>
            </x-card>

            <!-- Metode Pembayaran -->
            <div class="bg-[var(--color-secondary)] text-white shadow-xl rounded-[8px] p-[24px] transition-all duration-300 hover:shadow-2xl">
                <h3 class="font-display font-bold text-xl mb-4 border-b border-white/20 pb-2">Metode Pembayaran Resmi</h3>
                @if($masjid->rekenings && $masjid->rekenings->count() > 0)
                    <div class="space-y-4 mt-4">
                        @foreach($masjid->rekenings as $rek)
                        <div class="bg-white/10 p-4 rounded-lg backdrop-blur-sm">
                            <div class="font-bold text-lg mb-1">{{ $rek->platform }}</div>
                            <div class="font-mono text-xl tracking-wider mb-1">{{ $rek->nomor_rekening }}</div>
                            <div class="text-sm opacity-90">a.n. {{ $rek->atas_nama }}</div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white/10 p-4 rounded-lg text-sm font-body">
                        Belum ada info rekening/metode pembayaran yang ditambahkan oleh pengurus masjid ini.
                    </div>
                @endif
            </div>
        </div>

        <!-- Kolom Kanan: Pilihan Hewan -->
        <div class="lg:col-span-2 animate-fade-in-up" style="animation-delay: 0.1s;">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)]">Pilihan Kurban Tersedia</h2>
                <a href="{{ route('masjids.daftar', $masjid->id) }}">
                    <x-button variant="primary">Daftar Sekarang</x-button>
                </a>
            </div>

            @if($masjid->hewanKurbans && $masjid->hewanKurbans->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($masjid->hewanKurbans as $hewan)
                        @php
                            $sisa = $hewan->kapasitas_slot - $hewan->slot_terisi;
                        @endphp
                        <x-card class="bg-white border-[var(--color-border)] hover:shadow-lg transition-all group flex flex-col h-full {{ $sisa == 0 ? 'opacity-60 grayscale' : '' }}">
                            <div class="flex-grow">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h3 class="text-xl font-display font-bold text-[var(--color-secondary)] group-hover:text-[var(--color-accent)] transition-colors">{{ $hewan->jenis_hewan }}</h3>
                                        <p class="text-sm text-[var(--color-text-secondary)] font-body">{{ $hewan->deskripsi }}</p>
                                    </div>
                                    <span class="bg-[var(--color-primary)] text-[var(--color-secondary)] px-3 py-1 rounded-full text-xs font-bold font-mono">
                                        {{ $sisa }} Slot Tersisa
                                    </span>
                                </div>
                                <div class="space-y-2 mb-6">
                                    <div class="flex justify-between items-center border-b border-[var(--color-border)] pb-2">
                                        <span class="text-sm text-[var(--color-text-secondary)] font-body">Total Harga</span>
                                        <span class="font-mono font-bold text-[var(--color-text-primary)]">Rp {{ number_format($hewan->harga_total, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between items-center border-b border-[var(--color-border)] pb-2">
                                        <span class="text-sm text-[var(--color-text-secondary)] font-body">Kapasitas</span>
                                        <span class="font-mono font-bold text-[var(--color-text-primary)]">{{ $hewan->kapasitas_slot }} Orang</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span class="text-sm text-[var(--color-text-secondary)] font-body">Target/Orang</span>
                                        <span class="font-mono font-bold text-[var(--color-accent)]">Rp {{ number_format($hewan->target_per_slot, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mt-4 pt-4 border-t border-[var(--color-border)]">
                                @if($sisa > 0)
                                    <a href="{{ route('masjids.daftar', $masjid->id) }}?hewan={{ $hewan->id }}" class="block w-full">
                                        <x-button variant="secondary" class="w-full justify-center">Pilih Paket Ini</x-button>
                                    </a>
                                @else
                                    <x-button variant="danger" class="w-full justify-center" disabled>Slot Penuh</x-button>
                                @endif
                            </div>
                        </x-card>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-xl border border-[var(--color-border)]">
                    <p class="text-[var(--color-text-secondary)] font-body mb-4">Masjid ini belum menambahkan paket hewan kurban apa pun.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

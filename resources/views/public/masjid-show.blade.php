@extends('layouts.public-jemaah')

@section('title', 'Detail Masjid - Sylvan Kurban')

@section('content')
<div x-data="{ showKurbanModal: false, showPaymentModal: false }" class="py-16 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Hero Section -->
    <div class="mb-8 text-center animate-hero">
        <h1 class="text-4xl md:text-5xl font-display font-medium text-[var(--color-secondary)] mb-4">{{ $masjid->name }}</h1>
        <p class="text-lg text-[var(--color-text-secondary)] font-body max-w-2xl mx-auto">
            <i class="fa-solid fa-location-dot mr-2"></i> {{ $masjid->address ?? 'Alamat belum dilengkapi' }}, {{ $masjid->city ?? '-' }}
        </p>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row justify-center gap-4 mb-12 animate-fade-in-up">
        <button @click="showKurbanModal = true" class="inline-flex justify-center items-center px-8 py-4 border border-transparent text-base font-bold font-mono rounded-[8px] shadow-lg text-[var(--color-primary)] bg-[var(--color-accent)] hover:bg-[#b05e26] hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-accent)] transition-all duration-300">
            <i class="fa-solid fa-cow mr-3 text-xl"></i> Lihat Pilihan Kurban
        </button>
        <button @click="showPaymentModal = true" class="inline-flex justify-center items-center px-8 py-4 border border-[var(--color-secondary)] text-base font-bold font-mono rounded-[8px] shadow-lg text-[var(--color-secondary)] bg-[var(--color-surface)] hover:bg-[var(--color-background)] hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-secondary)] transition-all duration-300">
            <i class="fa-solid fa-money-check-dollar mr-3 text-xl"></i> Metode Pembayaran
        </button>
    </div>

    <!-- Tentang Masjid -->
    <div class="space-y-8 animate-fade-in-up delay-100">
        <x-card class="bg-[var(--color-surface)] border-[var(--color-border)] overflow-hidden p-0 shadow-sm hover:shadow-md transition-shadow">
            @if($masjid->gambar)
                <img src="{{ str_starts_with($masjid->gambar, 'http') ? $masjid->gambar : asset('storage/' . $masjid->gambar) }}" alt="{{ $masjid->name }}" class="w-full h-80 object-cover">
            @else
                <div class="w-full h-80 bg-[#e3e8e0] flex items-center justify-center text-[var(--color-text-secondary)]">
                    <i class="fa-regular fa-image text-5xl mb-2"></i>
                    <span class="block mt-4 font-body">Belum ada foto</span>
                </div>
            @endif
            <div class="p-8 md:p-12">
                <h3 class="font-display font-bold text-2xl text-[var(--color-secondary)] mb-6 border-b border-gray-100 pb-4">Tentang Masjid</h3>
                <p class="font-body text-[var(--color-text-primary)] whitespace-pre-line leading-relaxed text-justify mb-8">
                    {{ $masjid->deskripsi ?? 'Masjid ini belum menambahkan deskripsi profil mereka. Namun, mereka siap menerima tabungan kurban Anda.' }}
                </p>
                
                @if($masjid->kontak_person)
                <div class="flex items-center text-[var(--color-text-secondary)] font-body bg-[var(--color-background)] p-4 rounded-lg inline-flex">
                    <i class="fa-brands fa-whatsapp text-green-500 text-2xl mr-4"></i>
                    <div>
                        <span class="block text-xs font-bold text-[var(--color-text-secondary)] uppercase tracking-wider mb-1">Kontak Person / Takmir</span>
                        <span class="font-mono text-lg text-[var(--color-secondary)]">{{ $masjid->kontak_person }}</span>
                    </div>
                </div>
                @endif
            </div>
        </x-card>
    </div>

    <!-- Modal Pilihan Kurban -->
    <div x-show="showKurbanModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div x-show="showKurbanModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 backdrop-blur-sm" @click="showKurbanModal = false" aria-hidden="true"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <!-- Modal Panel -->
            <div x-show="showKurbanModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative inline-block w-full px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-[#f4f6f3] rounded-[8px] shadow-2xl sm:my-8 sm:align-middle sm:max-w-3xl sm:w-full sm:p-8">
                
                <!-- Close Button -->
                <div class="absolute top-0 right-0 pt-6 pr-6">
                    <button @click="showKurbanModal = false" class="text-[var(--color-text-secondary)] bg-[var(--color-surface)] rounded-full p-2 hover:bg-[var(--color-background)] hover:text-[var(--color-text-secondary)] focus:outline-none transition-colors">
                        <span class="sr-only">Tutup</span>
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="mt-2">
                    <h3 class="text-3xl font-display font-bold text-[var(--color-secondary)] mb-6 border-b border-[var(--color-border)] pb-4">Pilihan Kurban Tersedia</h3>
                    
                    <div class="max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                        @if($masjid->hewanKurbans && $masjid->hewanKurbans->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                @foreach($masjid->hewanKurbans as $hewan)
                                    @php
                                        $sisa = $hewan->kapasitas_slot - $hewan->slot_terisi;
                                    @endphp
                                    <x-card class="bg-[var(--color-surface)] border-[var(--color-border)] hover:shadow-lg transition-all group flex flex-col h-full {{ $sisa == 0 ? 'opacity-60 grayscale' : '' }}">
                                        <div class="flex-grow">
                                            <div class="flex justify-between items-start mb-4">
                                                <div>
                                                    <h3 class="text-xl font-display font-bold text-[var(--color-secondary)] group-hover:text-[var(--color-accent)] transition-colors">{{ $hewan->jenis_hewan }}</h3>
                                                    <p class="text-sm text-[var(--color-text-secondary)] font-body">{{ $hewan->deskripsi }}</p>
                                                </div>
                                                <span class="bg-[var(--color-primary)] text-[var(--color-secondary)] px-3 py-1 rounded-full text-xs font-bold font-mono whitespace-nowrap">
                                                    {{ $sisa }} Slot
                                                </span>
                                            </div>
                                            <div class="space-y-2 mb-6">
                                                <div class="flex justify-between items-center border-b border-gray-100 pb-2">
                                                    <span class="text-sm text-[var(--color-text-secondary)] font-body">Total Harga</span>
                                                    <span class="font-mono font-bold text-[var(--color-text-primary)]">Rp {{ number_format($hewan->harga_total, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="flex justify-between items-center border-b border-gray-100 pb-2">
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
                            <div class="text-center py-12 bg-[var(--color-surface)] rounded-[8px] border border-[var(--color-border)]">
                                <p class="text-[var(--color-text-secondary)] font-body mb-4">Masjid ini belum menambahkan paket hewan kurban apa pun.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Metode Pembayaran -->
    <div x-show="showPaymentModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div x-show="showPaymentModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 backdrop-blur-sm" @click="showPaymentModal = false" aria-hidden="true"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <!-- Modal Panel -->
            <div x-show="showPaymentModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="relative inline-block w-full px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-[var(--color-secondary)] rounded-[8px] shadow-2xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-8">
                
                <!-- Close Button -->
                <div class="absolute top-0 right-0 pt-6 pr-6">
                    <button @click="showPaymentModal = false" class="text-white/60 hover:text-white bg-[var(--color-surface)]/10 rounded-full p-2 hover:bg-[var(--color-surface)]/20 focus:outline-none transition-colors">
                        <span class="sr-only">Tutup</span>
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <div class="mt-2 text-white">
                    <h3 class="text-2xl font-display font-bold mb-6 border-b border-white/20 pb-4">Metode Pembayaran Resmi</h3>
                    
                    <div class="max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                        @if($masjid->rekenings && $masjid->rekenings->count() > 0)
                            <div class="space-y-4">
                                @foreach($masjid->rekenings as $rek)
                                <div class="bg-[var(--color-surface)]/10 p-6 rounded-lg backdrop-blur-sm border border-white/10 hover:bg-[var(--color-surface)]/20 transition-colors">
                                    <div class="font-bold text-xl mb-2 text-[var(--color-primary)]">{{ $rek->platform }}</div>
                                    <div class="font-mono text-2xl tracking-wider mb-2 font-bold">{{ $rek->nomor_rekening }}</div>
                                    <div class="text-sm text-gray-300">Atas Nama: <span class="text-white font-medium">{{ $rek->atas_nama }}</span></div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="bg-[var(--color-surface)]/10 p-6 rounded-lg text-sm font-body text-center">
                                <i class="fa-solid fa-wallet text-3xl mb-3 opacity-50"></i>
                                <p>Belum ada informasi rekening atau metode pembayaran yang ditambahkan oleh pengurus masjid ini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
/* Custom Scrollbar for Modals */
.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(0,0,0,0.05); 
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(0,0,0,0.2); 
    border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(0,0,0,0.3); 
}
</style>
@endsection

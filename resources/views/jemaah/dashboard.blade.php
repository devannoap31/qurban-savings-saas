@extends('layouts.app')

@section('title', 'Dashboard Jemaah - Sylvan Kurban')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="bg-[var(--color-surface)] border border-[var(--color-border)] p-8 rounded-[8px] mb-12 flex flex-col md:flex-row justify-between items-center shadow-sm animate-hero">
        <div>
            <h2 class="text-3xl font-display font-medium text-[var(--color-secondary)]">Assalamu'alaikum, {{ $jemaah->nama_jemaah }}</h2>
            <p class="text-[var(--color-text-secondary)] font-body mt-2 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $jemaah->masjid->name }} &nbsp;•&nbsp; Slot {{ $jemaah->hewanKurban->deskripsi }}
            </p>
        </div>
        <div class="w-16 h-16 rounded-full bg-[var(--color-accent)] text-[var(--color-primary)] flex items-center justify-center font-display font-bold text-2xl mt-6 md:mt-0 shadow-md">
            {{ substr($jemaah->nama_jemaah, 0, 2) }}
        </div>
    </div>

    <!-- Overview Tabungan -->
    @php
        $target = $jemaah->hewanKurban->target_per_slot;
        $terkumpul = $jemaah->total_saldo;
        $progress = $target > 0 ? min(100, round(($terkumpul / $target) * 100)) : 0;
        $sisa = max(0, $target - $terkumpul);
    @endphp
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
        <x-card class="text-center flex flex-col items-center justify-center py-12 animate-card border-none bg-transparent shadow-none hover:shadow-none">
            <h3 class="text-xl font-display font-medium text-[var(--color-secondary)] mb-8">Pertumbuhan Tabungan</h3>
            
            <div class="relative w-48 h-48">
                <svg class="w-full h-full" viewBox="0 0 100 100">
                    <circle class="text-[#e3e8e0] stroke-current" stroke-width="6" cx="50" cy="50" r="44" fill="transparent"></circle>
                    <circle class="text-[var(--color-accent)] stroke-current transition-all duration-1000 ease-out" stroke-width="6" stroke-linecap="round" cx="50" cy="50" r="44" fill="transparent" stroke-dasharray="{{ 2 * 3.14159 * 44 }}" stroke-dashoffset="{{ (2 * 3.14159 * 44) - ((2 * 3.14159 * 44) * $progress) / 100 }}" transform="rotate(-90 50 50)"></circle>
                </svg>
                <div class="absolute inset-0 flex items-center justify-center flex-col">
                    <span class="text-4xl font-display font-bold text-[var(--color-secondary)]">{{ $progress }}%</span>
                </div>
            </div>
            
            <p class="mt-6 text-[var(--color-text-secondary)] font-body text-lg">Terkumpul: <span class="font-bold text-[var(--color-secondary)]">Rp {{ number_format($terkumpul, 0, ',', '.') }}</span></p>
        </x-card>
        
        <x-card class="flex flex-col justify-center animate-card">
            <h3 class="text-lg font-mono font-semibold text-[var(--color-text-secondary)] mb-2 uppercase tracking-wider">Sisa Pembinaan Kurban</h3>
            <p class="text-5xl font-display font-medium text-[var(--color-secondary)] mb-4">Rp {{ number_format($sisa, 0, ',', '.') }}</p>
            <p class="text-[var(--color-text-secondary)] font-body mb-8 border-b border-[var(--color-border)] pb-6">Target: Rp {{ number_format($target, 0, ',', '.') }}</p>
            
            @if($sisa > 0)
                <div class="bg-amber-50 text-amber-800 p-4 rounded-[4px] text-sm font-body border border-amber-200 flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span>Sisa waktu pelunasan tabungan adalah 14 hari sebelum Idul Adha. Harap segera melunasi agar slot tidak digantikan.</span>
                </div>
            @else
                <div class="bg-[#e3e8e0] text-[var(--color-accent)] p-4 rounded-[4px] text-sm font-body font-medium flex items-start gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Alhamdulillah, tabungan Anda sudah lunas. Semoga menjadi amal jariyah yang terus bertumbuh.</span>
                </div>
            @endif
        </x-card>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Riwayat Setoran -->
        <div class="animate-card">
            <h3 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-6">Jejak Tabungan</h3>
            <x-card class="p-0 overflow-hidden">
                @if($setorans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-[var(--color-border)]">
                                    <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">TANGGAL</th>
                                    <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">NOMINAL</th>
                                    <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">STATUS</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[var(--color-border)] font-body">
                                @foreach($setorans as $setoran)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="py-5 px-6 text-sm">{{ \Carbon\Carbon::parse($setoran->tanggal_setor)->translatedFormat('d F Y') }}</td>
                                    <td class="py-5 px-6 text-sm font-medium text-[var(--color-secondary)]">Rp {{ number_format($setoran->nominal, 0, ',', '.') }}</td>
                                    <td class="py-5 px-6">
                                        <span class="inline-block px-3 py-1 bg-[#e3e8e0] text-[var(--color-accent)] text-xs font-mono rounded-full">DITERIMA</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-10 text-center text-[var(--color-text-secondary)] font-body">
                        Belum ada jejak setoran tabungan.
                    </div>
                @endif
            </x-card>
        </div>

        <!-- Transparansi Pengeluaran -->
        <div class="animate-card">
            <h3 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-6">Transparansi Pengeluaran</h3>
            <x-card class="p-0 overflow-hidden">
                <div class="p-6 bg-[#e3e8e0] border-b border-[var(--color-border)]">
                    <p class="text-[var(--color-accent)] font-body text-sm">Laporan penggunaan dana khusus untuk hewan kurban Anda. Amanah dan dapat dipertanggungjawabkan.</p>
                </div>
                
                @if($pengeluarans->count() > 0)
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($pengeluarans as $pengeluaran)
                            <div class="flex justify-between items-center p-5 border border-[var(--color-border)] rounded-[8px] hover:shadow-sm transition bg-[var(--color-surface)]">
                                <div>
                                    <p class="font-display font-medium text-[var(--color-secondary)]">{{ $pengeluaran->nama_pengeluaran }}</p>
                                    <p class="text-xs font-mono text-[var(--color-text-secondary)] mt-1">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->translatedFormat('d F Y') }}</p>
                                </div>
                                <div class="font-mono text-sm font-bold text-[var(--color-secondary)]">
                                    Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="p-10 text-center text-[var(--color-text-secondary)] font-body">
                        Belum ada catatan pengeluaran dari panitia.
                    </div>
                @endif
            </x-card>
        </div>
    </div>
</div>
@endsection

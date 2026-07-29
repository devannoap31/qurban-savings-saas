@extends('layouts.dashboard-jemaah')

@section('title', 'Dasbor Jemaah - Sylvan Kurban')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    @if(session('success'))
        <div class="bg-[var(--color-success)] text-white p-4 rounded-[8px] mb-8 font-body animate-hero shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-10 animate-hero flex flex-col md:flex-row md:items-end md:justify-between gap-6">
        <div>
            <h1 class="text-4xl font-display font-medium text-[var(--color-secondary)]">Dasbor Transparansi</h1>
            <p class="text-[var(--color-text-secondary)] font-body mt-2">Selamat datang, <span class="font-bold text-[var(--color-secondary)]">{{ Auth::user()->name }}</span></p>
        </div>
        <div class="bg-[var(--color-surface)] px-5 py-3 rounded-lg border border-[var(--color-border)] shadow-sm inline-flex items-center">
            <span class="w-3 h-3 rounded-full bg-[var(--color-success)] mr-3 animate-pulse"></span>
            <span class="font-mono text-sm text-[var(--color-text-secondary)]">Status: <strong class="text-[var(--color-secondary)]">Terdaftar di {{ $jemaahs->count() }} Masjid</strong></span>
        </div>
    </div>

    <!-- Info Masjid & Kurban -->
    @foreach($jemaahs as $jemaah)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <div class="lg:col-span-2">
            <x-card class="animate-card h-full bg-[var(--color-surface)] border-[var(--color-border)]">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-xl font-display font-bold text-[var(--color-secondary)] mb-1">Target Tabungan</h2>
                        <p class="font-body text-sm text-[var(--color-text-secondary)]">
                            Pilihan: <span class="font-semibold text-[var(--color-text-primary)]">{{ $jemaah->hewanKurban->jenis_hewan }} ({{ $jemaah->hewanKurban->deskripsi }})</span>
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-mono text-[var(--color-text-secondary)] mb-1">Total Saldo</p>
                        <p class="text-2xl font-mono font-bold text-[var(--color-accent)] mb-2">Rp {{ number_format($jemaah->total_saldo, 0, ',', '.') }}</p>
                        <a href="{{ route('jemaah.cetak-laporan', $jemaah->id) }}" class="inline-flex items-center text-xs font-mono font-bold text-[var(--color-secondary)] bg-[var(--color-background)] hover:bg-[#e3e8e0] px-3 py-1.5 rounded-[8px] border border-[var(--color-border)] transition-colors">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            Cetak Laporan PDF
                        </a>
                    </div>
                </div>

                @php
                    $target = $jemaah->hewanKurban->target_per_slot;
                    $persentase = $target > 0 ? min(100, round(($jemaah->total_saldo / $target) * 100)) : 0;
                @endphp

                <div class="mb-4">
                    <div class="flex justify-between text-sm font-mono mb-2">
                        <span class="text-[var(--color-text-secondary)]">Progres</span>
                        <span class="font-bold text-[var(--color-secondary)]">{{ $persentase }}% dari Rp {{ number_format($target, 0, ',', '.') }}</span>
                    </div>
                    <div class="w-full bg-[var(--color-background)] rounded-full h-3 overflow-hidden border border-[var(--color-border)]">
                        <div class="bg-[var(--color-accent)] h-full rounded-full transition-all duration-1000" style="width: {{ $persentase }}%"></div>
                    </div>
                </div>
                
                @if($persentase >= 100)
                    <div class="bg-[#cce8d6] text-[var(--color-secondary)] p-4 rounded-lg font-body text-sm mt-6 flex items-start">
                        <svg class="w-5 h-5 text-[var(--color-accent)] mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Alhamdulillah, tabungan kurban Anda telah mencapai target! Panitia akan segera mengonfirmasi persiapan hewan kurban Anda.
                    </div>
                @else
                    <p class="text-sm font-body text-[var(--color-text-secondary)] italic mt-4">
                        Kekurangan: Rp {{ number_format($target - $jemaah->total_saldo, 0, ',', '.') }}
                    </p>
                @endif
            </x-card>
        </div>

        <div class="lg:col-span-1">
            <div class="animate-card h-full bg-[#0E2116] text-[#F3F6F3] rounded-[8px] p-8 shadow-sm" x-data="{ showRekening{{ $jemaah->id }}: false }">
                <h3 class="font-display font-bold text-lg mb-4 text-[#cce8d6]">Masjid Pilihan Anda</h3>
                <h4 class="text-2xl font-display font-medium mb-2">{{ $jemaah->masjid->name }}</h4>
                <p class="font-body text-sm text-gray-300 mb-6 flex items-start">
                    <svg class="w-4 h-4 mr-2 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    {{ $jemaah->masjid->address ?? 'Alamat belum diatur' }}
                </p>
                <div class="pt-6 border-t border-[#1a3423]">
                    <p class="font-body text-sm text-gray-300 mb-4">Untuk melakukan setoran tabungan, silakan transfer ke rekening resmi masjid dan konfirmasikan ke takmir.</p>
                    <x-button variant="primary" class="w-full justify-center bg-[#F3F6F3] text-[#0E2116] hover:bg-[#e3e8e0]" @click="showRekening{{ $jemaah->id }} = true">Lihat Info Rekening</x-button>
                </div>
                
                <!-- Modal Info Rekening -->
                <template x-teleport="body">
                    <div x-show="showRekening{{ $jemaah->id }}" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
                        <div @click.away="showRekening{{ $jemaah->id }} = false" class="bg-[var(--color-surface)] rounded-[8px] shadow-2xl p-6 w-full max-w-md text-[#111827]">
                            <div class="flex justify-between items-center mb-6 border-b pb-3">
                                <h3 class="font-display font-bold text-xl text-[#0E2116]">Rekening {{ $jemaah->masjid->name }}</h3>
                                <button @click="showRekening{{ $jemaah->id }} = false" class="text-[var(--color-text-secondary)] hover:text-red-600 transition"><i class="fa-solid fa-times text-xl"></i></button>
                            </div>
                            
                            <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2">
                                @if($jemaah->masjid->rekenings && $jemaah->masjid->rekenings->count() > 0)
                                    @foreach($jemaah->masjid->rekenings as $rek)
                                        <div class="p-4 border border-[var(--color-border)] rounded-lg bg-[var(--color-background)] relative overflow-hidden group">
                                            <div class="absolute right-0 top-0 w-16 h-16 bg-[#2A4E35] opacity-10 rounded-bl-full"></div>
                                            <div class="font-bold text-[#0E2116] text-lg mb-1">{{ $rek->platform }}</div>
                                            <div class="font-mono text-xl tracking-wider text-[#2A4E35] mb-2 font-bold">{{ $rek->nomor_rekening }}</div>
                                            <div class="text-sm text-[var(--color-text-secondary)]">a.n. <span class="font-semibold">{{ $rek->atas_nama }}</span></div>
                                        </div>
                                    @endforeach
                                    <div class="mt-4 p-3 bg-blue-50 text-blue-800 text-xs font-body rounded-[8px] border border-blue-100">
                                        <strong>Penting:</strong> Setelah transfer, mohon konfirmasi ke pihak masjid (Takmir) agar setoran Anda dicatat ke dalam sistem.
                                    </div>
                                @else
                                    <div class="p-8 text-center text-[var(--color-text-secondary)] bg-[var(--color-background)] rounded-lg border border-dashed border-[var(--color-border)]">
                                        <i class="fa-solid fa-wallet text-3xl mb-3 text-gray-300"></i>
                                        <p>Masjid belum menambahkan informasi rekening/pembayaran.</p>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="mt-6">
                                <x-button @click="showRekening{{ $jemaah->id }} = false" variant="secondary" class="w-full justify-center">Tutup</x-button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Riwayat & Transparansi -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Riwayat Setoran -->
        <div class="animate-card">
            <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-6">Riwayat Setoran Anda</h2>
            <x-card class="p-0 overflow-hidden bg-[var(--color-surface)] border-[var(--color-border)]">
                <ul class="divide-y divide-[var(--color-border)]">
                    @forelse($setorans as $setoran)
                        <li class="p-5 flex justify-between items-center hover:bg-[var(--color-background)] transition">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-[#e3e8e0] text-[var(--color-accent)] flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path></svg>
                                </div>
                                <div>
                                    <p class="font-display font-medium text-[var(--color-secondary)]">Setoran Tabungan</p>
                                    <p class="text-xs font-mono text-[var(--color-text-secondary)] mt-1">{{ \Carbon\Carbon::parse($setoran->tanggal_setor)->translatedFormat('d M Y') }} &bull; <span class="font-semibold">{{ $setoran->masjid->name ?? 'Masjid' }}</span></p>
                                </div>
                            </div>
                            <span class="font-mono font-bold text-[var(--color-success)]">+ Rp {{ number_format($setoran->nominal, 0, ',', '.') }}</span>
                        </li>
                    @empty
                        <li class="p-10 text-center">
                            <p class="font-body text-[var(--color-text-secondary)]">Belum ada riwayat setoran.</p>
                        </li>
                    @endforelse
                </ul>
            </x-card>
        </div>

        <!-- Transparansi Pengeluaran -->
        <div class="animate-card">
            <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-6">Transparansi Dana Panitia</h2>
            <x-card class="p-0 overflow-hidden bg-[var(--color-surface)] border-[var(--color-border)]">
                <ul class="divide-y divide-[var(--color-border)]">
                    @forelse($pengeluarans as $pengeluaran)
                        <li class="p-5 flex justify-between items-center hover:bg-[var(--color-background)] transition">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-red-50 text-[var(--color-error)] flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path></svg>
                                </div>
                                <div>
                                    <p class="font-display font-medium text-[var(--color-secondary)]">{{ $pengeluaran->nama_pengeluaran }}</p>
                                    <p class="text-xs font-mono text-[var(--color-text-secondary)] mt-1">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->translatedFormat('d M Y') }} &bull; <span class="font-semibold">{{ $pengeluaran->masjid->name ?? 'Masjid' }} ({{ $pengeluaran->hewanKurban->jenis_hewan ?? 'Hewan' }})</span></p>
                                </div>
                            </div>
                            <span class="font-mono font-bold text-[var(--color-error)]">- Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}</span>
                        </li>
                    @empty
                        <li class="p-10 text-center">
                            <p class="font-body text-[var(--color-text-secondary)]">Panitia belum mencatat pengeluaran apapun.</p>
                        </li>
                    @endforelse
                </ul>
            </x-card>
        </div>
    </div>
</div>
@endsection

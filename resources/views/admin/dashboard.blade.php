@extends('layouts.app')

@section('title', 'Dashboard Admin - Sylvan Kurban')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ tab: 'overview' }">
    
    <div class="mb-10 animate-hero">
        <h1 class="text-4xl font-display font-medium text-[var(--color-secondary)]">Dashboard Pengurus</h1>
        <p class="text-[var(--color-text-secondary)] font-body mt-2">Masjid: <span class="font-bold text-[var(--color-secondary)]">{{ $masjid->name ?? 'Belum Diatur' }}</span></p>
    </div>

    <!-- Alpine.js Tabs Navigation -->
    <div class="border-b border-[var(--color-border)] mb-10 overflow-x-auto animate-hero">
        <nav class="-mb-px flex space-x-10" aria-label="Tabs">
            <button @click="tab = 'overview'" 
                    :class="{'border-[var(--color-accent)] text-[var(--color-secondary)]': tab === 'overview', 'border-transparent text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:border-[var(--color-border)]': tab !== 'overview'}" 
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-display font-medium text-sm transition uppercase tracking-wider">
                Ringkasan
            </button>
            
            <button @click="tab = 'hewan'" 
                    :class="{'border-[var(--color-accent)] text-[var(--color-secondary)]': tab === 'hewan', 'border-transparent text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:border-[var(--color-border)]': tab !== 'hewan'}" 
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-display font-medium text-sm transition uppercase tracking-wider">
                Data Hewan
            </button>
            
            <button @click="tab = 'jemaah'" 
                    :class="{'border-[var(--color-accent)] text-[var(--color-secondary)]': tab === 'jemaah', 'border-transparent text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:border-[var(--color-border)]': tab !== 'jemaah'}" 
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-display font-medium text-sm transition uppercase tracking-wider">
                Daftar Jemaah
            </button>
            
            <button @click="tab = 'setoran'" 
                    :class="{'border-[var(--color-accent)] text-[var(--color-secondary)]': tab === 'setoran', 'border-transparent text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:border-[var(--color-border)]': tab !== 'setoran'}" 
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-display font-medium text-sm transition uppercase tracking-wider">
                Buku Kas
            </button>
        </nav>
    </div>

    <!-- Tab Contents -->
    
    <!-- 1. Overview Tab -->
    <div x-show="tab === 'overview'" x-transition.opacity>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <x-card class="animate-card">
                <p class="text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2 uppercase tracking-wider">Total Dana Terkumpul</p>
                <p class="text-4xl font-display font-medium text-[var(--color-secondary)]">Rp {{ number_format($totalSaldoTerkumpul, 0, ',', '.') }}</p>
            </x-card>
            <x-card class="animate-card">
                <p class="text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2 uppercase tracking-wider">Total Sapi & Kambing</p>
                <p class="text-4xl font-display font-medium text-[var(--color-secondary)]">{{ $hewanKurbans->count() }} <span class="text-lg font-body text-[var(--color-text-secondary)] italic">Ekor</span></p>
            </x-card>
            <x-card class="animate-card">
                <p class="text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2 uppercase tracking-wider">Jemaah Terdaftar</p>
                <p class="text-4xl font-display font-medium text-[var(--color-secondary)]">{{ $jemaahs->count() }} <span class="text-lg font-body text-[var(--color-text-secondary)] italic">Orang</span></p>
            </x-card>
        </div>
        
        <x-card class="p-0 overflow-hidden animate-card">
            <div class="p-6 border-b border-[var(--color-border)] flex justify-between items-center bg-[#e3e8e0]">
                <h3 class="font-display font-bold text-[var(--color-secondary)]">Aktivitas Setoran Terbaru</h3>
                <button @click="tab = 'setoran'" class="text-sm font-mono text-[var(--color-accent)] font-semibold hover:underline">LIHAT SEMUA</button>
            </div>
            <div class="p-0">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-[var(--color-border)] font-body">
                        @forelse($setorans->take(5) as $setoran)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-5 px-6 font-display font-medium text-[var(--color-secondary)]">{{ $setoran->jemaah->nama_jemaah }}</td>
                            <td class="py-5 px-6 text-sm font-mono text-[var(--color-text-secondary)]">{{ \Carbon\Carbon::parse($setoran->tanggal_setor)->translatedFormat('d M Y') }}</td>
                            <td class="py-5 px-6 font-mono font-bold text-[var(--color-secondary)] text-right">Rp {{ number_format($setoran->nominal, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="py-10 text-center font-body text-[var(--color-text-secondary)]">Belum ada aktivitas setoran.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
    
    <!-- 2. Hewan Kurban Tab -->
    <div x-show="tab === 'hewan'" x-transition.opacity style="display: none;">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)]">Daftar Hewan Kurban</h2>
            <x-button variant="primary" onclick="alert('Form tambah hewan kurban akan muncul.')">+ Tambah Hewan</x-button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($hewanKurbans as $hewan)
            <x-card class="animate-card">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h3 class="font-display font-bold text-xl text-[var(--color-secondary)]">{{ $hewan->deskripsi }}</h3>
                        <p class="text-sm font-body text-[var(--color-text-secondary)] mt-1">Jenis: {{ $hewan->jenis_hewan }}</p>
                    </div>
                    <span class="bg-[#e3e8e0] px-3 py-1 rounded-full text-xs font-mono font-bold text-[var(--color-accent)]">{{ $hewan->slot_terisi }}/{{ $hewan->kapasitas_slot }} Slot</span>
                </div>
                
                <div class="space-y-4 font-body border-t border-[var(--color-border)] pt-5">
                    <div class="flex justify-between items-end">
                        <span class="text-sm text-[var(--color-text-secondary)]">Harga (Inc. Ops):</span>
                        <span class="font-mono font-semibold text-[var(--color-secondary)]">Rp {{ number_format($hewan->harga_total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between items-end">
                        <span class="text-sm text-[var(--color-text-secondary)]">Target Per Slot:</span>
                        <span class="font-mono font-semibold text-[var(--color-secondary)]">Rp {{ number_format($hewan->target_per_slot, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="mt-8">
                    <x-button variant="outline" class="w-full" onclick="alert('Edit hewan kurban.')">Edit Data</x-button>
                </div>
            </x-card>
            @endforeach
        </div>
    </div>
    
    <!-- 3. Jemaah Tab -->
    <div x-show="tab === 'jemaah'" x-transition.opacity style="display: none;">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)]">Manajemen Jemaah</h2>
            <x-button variant="primary" onclick="alert('Form tambah jemaah.')">+ Pendaftar Baru</x-button>
        </div>
        
        <x-card class="p-0 overflow-hidden animate-card">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#e3e8e0] border-b border-[var(--color-border)]">
                            <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">NAMA JEMAAH</th>
                            <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">PILIHAN</th>
                            <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">SALDO</th>
                            <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">STATUS</th>
                            <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--color-border)] font-body">
                        @forelse($jemaahs as $j)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-5 px-6 font-display font-medium text-[var(--color-secondary)]">{{ $j->nama_jemaah }}</td>
                            <td class="py-5 px-6 text-sm text-[var(--color-text-secondary)]">{{ $j->hewanKurban->deskripsi ?? '-' }}</td>
                            <td class="py-5 px-6 font-mono font-bold text-[var(--color-secondary)]">Rp {{ number_format($j->total_saldo, 0, ',', '.') }}</td>
                            <td class="py-5 px-6">
                                <span class="bg-[#e3e8e0] text-[var(--color-accent)] px-3 py-1 rounded-full text-xs font-mono font-bold">{{ $j->status }}</span>
                            </td>
                            <td class="py-5 px-6 text-sm flex gap-4">
                                <button class="font-mono text-[var(--color-accent)] font-semibold hover:underline" onclick="alert('Detail jemaah.')">DETAIL</button>
                                <button class="font-mono text-[var(--color-error)] font-semibold hover:underline" onclick="alert('Batal')">BATAL</button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="py-10 text-center font-body text-[var(--color-text-secondary)]">Belum ada jemaah terdaftar.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
    
    <!-- 4. Setoran & Keuangan Tab -->
    <div x-show="tab === 'setoran'" x-transition.opacity style="display: none;">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Kolom Setoran -->
            <div class="animate-card">
                <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-6">Pencatatan Setoran</h2>
                
                <x-card class="mb-8 bg-white border-[var(--color-border)]">
                    <form onsubmit="event.preventDefault(); alert('Simulasi form submit setoran berhasil!');">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">PILIH JEMAAH</label>
                                <select class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                                    @foreach($jemaahs as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jemaah }} - Saldo: Rp {{ number_format($j->total_saldo, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">NOMINAL (RP)</label>
                                <input type="number" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono" placeholder="500000">
                            </div>
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">TANGGAL SETOR</label>
                                <input type="date" required value="{{ date('Y-m-d') }}" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono">
                            </div>
                            <x-button variant="secondary" type="submit" class="w-full justify-center">Simpan Setoran</x-button>
                        </div>
                    </form>
                </x-card>
                
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-4">Riwayat Terakhir</h3>
                <x-card class="p-0 overflow-hidden bg-white">
                    <ul class="divide-y divide-[var(--color-border)]">
                        @foreach($setorans->take(5) as $setoran)
                        <li class="p-5 flex justify-between items-center hover:bg-gray-50 transition">
                            <div>
                                <p class="font-display font-medium text-[var(--color-secondary)]">{{ $setoran->jemaah->nama_jemaah }}</p>
                                <p class="text-xs font-mono text-[var(--color-text-secondary)] mt-1">{{ \Carbon\Carbon::parse($setoran->tanggal_setor)->translatedFormat('d M Y') }}</p>
                            </div>
                            <span class="font-mono font-bold text-[var(--color-success)]">+ Rp {{ number_format($setoran->nominal, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>
                </x-card>
            </div>
            
            <!-- Kolom Pengeluaran -->
            <div class="animate-card">
                <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-6">Catat Pengeluaran</h2>
                
                <x-card class="mb-8 bg-white">
                    <form onsubmit="event.preventDefault(); alert('Simulasi form submit pengeluaran berhasil!');">
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">UNTUK HEWAN</label>
                                <select class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                                    @foreach($hewanKurbans as $h)
                                        <option value="{{ $h->id }}">{{ $h->deskripsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">NAMA PENGELUARAN</label>
                                <input type="text" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body" placeholder="Beli pakan">
                            </div>
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">NOMINAL (RP)</label>
                                <input type="number" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono" placeholder="150000">
                            </div>
                            <x-button variant="danger" type="submit" class="w-full justify-center">Catat Pengeluaran</x-button>
                        </div>
                    </form>
                </x-card>
                
                <h3 class="text-lg font-display font-bold text-[var(--color-secondary)] mb-4">Pengeluaran Tercatat</h3>
                <x-card class="p-0 overflow-hidden bg-white">
                    <ul class="divide-y divide-[var(--color-border)]">
                        @foreach($pengeluarans->take(5) as $pengeluaran)
                        <li class="p-5 flex justify-between items-center hover:bg-gray-50 transition">
                            <div>
                                <p class="font-display font-medium text-[var(--color-secondary)]">{{ $pengeluaran->nama_pengeluaran }}</p>
                                <p class="text-xs font-mono text-[var(--color-text-secondary)] mt-1">Untuk: {{ $pengeluaran->hewanKurban->deskripsi }}</p>
                            </div>
                            <span class="font-mono font-bold text-[var(--color-error)]">- Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>
                </x-card>
            </div>
        </div>
    </div>
</div>
@endsection

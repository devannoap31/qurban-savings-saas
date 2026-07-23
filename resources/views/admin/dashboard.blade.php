@extends('layouts.app')

@section('title', 'Dashboard Admin - Tabungan Kurban')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="{ tab: 'overview' }">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[var(--color-on-surface)]">Dashboard Admin</h1>
        <p class="text-[var(--color-muted)] mt-1">Masjid: {{ $masjid->name ?? 'Belum Diatur' }}</p>
    </div>

    <!-- Alpine.js Tabs Navigation -->
    <div class="border-b border-[var(--color-border)] mb-8 overflow-x-auto">
        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
            <button @click="tab = 'overview'" 
                    :class="{'border-[var(--color-primary)] text-[var(--color-primary)]': tab === 'overview', 'border-transparent text-[var(--color-muted)] hover:text-[var(--color-on-surface)] hover:border-[var(--color-border)]': tab !== 'overview'}" 
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">
                Overview
            </button>
            
            <button @click="tab = 'hewan'" 
                    :class="{'border-[var(--color-primary)] text-[var(--color-primary)]': tab === 'hewan', 'border-transparent text-[var(--color-muted)] hover:text-[var(--color-on-surface)] hover:border-[var(--color-border)]': tab !== 'hewan'}" 
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">
                Hewan Kurban
            </button>
            
            <button @click="tab = 'jemaah'" 
                    :class="{'border-[var(--color-primary)] text-[var(--color-primary)]': tab === 'jemaah', 'border-transparent text-[var(--color-muted)] hover:text-[var(--color-on-surface)] hover:border-[var(--color-border)]': tab !== 'jemaah'}" 
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">
                Data Jemaah
            </button>
            
            <button @click="tab = 'setoran'" 
                    :class="{'border-[var(--color-primary)] text-[var(--color-primary)]': tab === 'setoran', 'border-transparent text-[var(--color-muted)] hover:text-[var(--color-on-surface)] hover:border-[var(--color-border)]': tab !== 'setoran'}" 
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition">
                Setoran & Keuangan
            </button>
        </nav>
    </div>

    <!-- Tab Contents -->
    
    <!-- 1. Overview Tab -->
    <div x-show="tab === 'overview'" x-transition.opacity>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-[var(--color-tertiary)] border border-[var(--color-border)] rounded-[8px] p-6 shadow-sm">
                <p class="text-sm font-medium text-[var(--color-muted)] mb-1">Total Saldo Terkumpul</p>
                <p class="text-3xl font-bold text-[var(--color-on-surface)]">Rp {{ number_format($totalSaldoTerkumpul, 0, ',', '.') }}</p>
            </div>
            <div class="bg-[var(--color-tertiary)] border border-[var(--color-border)] rounded-[8px] p-6 shadow-sm">
                <p class="text-sm font-medium text-[var(--color-muted)] mb-1">Jumlah Hewan Kurban</p>
                <p class="text-3xl font-bold text-[var(--color-on-surface)]">{{ $hewanKurbans->count() }} <span class="text-lg font-normal text-[var(--color-muted)]">Unit</span></p>
            </div>
            <div class="bg-[var(--color-tertiary)] border border-[var(--color-border)] rounded-[8px] p-6 shadow-sm">
                <p class="text-sm font-medium text-[var(--color-muted)] mb-1">Jemaah Terdaftar</p>
                <p class="text-3xl font-bold text-[var(--color-on-surface)]">{{ $jemaahs->count() }} <span class="text-lg font-normal text-[var(--color-muted)]">Orang</span></p>
            </div>
        </div>
        
        <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] shadow-sm overflow-hidden">
            <div class="p-6 border-b border-[var(--color-border)] flex justify-between items-center bg-[var(--color-tertiary)]">
                <h3 class="font-bold text-[var(--color-on-surface)]">Aktivitas Setoran Terbaru</h3>
                <button @click="tab = 'setoran'" class="text-sm text-[var(--color-primary)] font-medium hover:underline">Lihat Semua</button>
            </div>
            <div class="p-0">
                <table class="w-full text-left border-collapse">
                    <tbody class="divide-y divide-[var(--color-border)]">
                        @forelse($setorans->take(5) as $setoran)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 text-sm font-medium text-[var(--color-on-surface)]">{{ $setoran->jemaah->nama_jemaah }}</td>
                            <td class="py-4 px-6 text-sm text-[var(--color-muted)]">{{ \Carbon\Carbon::parse($setoran->tanggal_setor)->translatedFormat('d M Y') }}</td>
                            <td class="py-4 px-6 text-sm font-bold text-[var(--color-on-surface)] text-right">Rp {{ number_format($setoran->nominal, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="py-6 text-center text-[var(--color-muted)]">Belum ada aktivitas setoran.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- 2. Hewan Kurban Tab -->
    <div x-show="tab === 'hewan'" x-transition.opacity style="display: none;">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-[var(--color-on-surface)]">Daftar Hewan Kurban</h2>
            <button class="bg-[var(--color-primary)] text-white px-4 py-2 rounded-[4px] text-sm font-medium hover:bg-blue-700 transition" onclick="alert('Form tambah hewan kurban akan muncul.')">+ Tambah Hewan</button>
        </div>
        
        <div class="bg-blue-50 border border-blue-200 text-blue-800 p-4 rounded-[4px] text-sm font-medium mb-6">
            ℹ️ Sesuai instruksi revisi PRD: Pastikan Harga Total mencakup (Harga Hewan + Biaya Operasional).
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($hewanKurbans as $hewan)
            <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] p-6 shadow-sm">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-bold text-lg text-[var(--color-on-surface)]">{{ $hewan->deskripsi }}</h3>
                        <p class="text-sm text-[var(--color-muted)]">Jenis: {{ $hewan->jenis_hewan }}</p>
                    </div>
                    <span class="bg-[var(--color-tertiary)] px-3 py-1 rounded-full text-xs font-bold text-[var(--color-on-surface)]">{{ $hewan->slot_terisi }}/{{ $hewan->kapasitas_slot }} Slot Terisi</span>
                </div>
                
                <div class="space-y-3 mt-6 border-t border-[var(--color-border)] pt-4">
                    <div class="flex justify-between">
                        <span class="text-sm text-[var(--color-muted)]">Harga Total (Inc. Ops):</span>
                        <span class="text-sm font-bold text-[var(--color-on-surface)]">Rp {{ number_format($hewan->harga_total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-[var(--color-muted)]">Target Per Slot:</span>
                        <span class="text-sm font-bold text-[var(--color-on-surface)]">Rp {{ number_format($hewan->target_per_slot, 0, ',', '.') }}</span>
                    </div>
                </div>
                
                <div class="mt-6 flex gap-2">
                    <button class="flex-1 bg-[var(--color-tertiary)] text-[var(--color-on-surface)] px-4 py-2 rounded-[4px] text-sm font-medium hover:bg-gray-200 transition border border-[var(--color-border)]" onclick="alert('Edit hewan kurban.')">Edit Data</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    
    <!-- 3. Jemaah Tab -->
    <div x-show="tab === 'jemaah'" x-transition.opacity style="display: none;">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-[var(--color-on-surface)]">Manajemen Jemaah</h2>
            <button class="bg-[var(--color-primary)] text-white px-4 py-2 rounded-[4px] text-sm font-medium hover:bg-blue-700 transition" onclick="alert('Form tambah jemaah.')">+ Daftarkan Jemaah</button>
        </div>
        
        <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[var(--color-tertiary)] border-b border-[var(--color-border)]">
                            <th class="py-3 px-6 text-sm font-semibold text-[var(--color-muted)]">Nama Jemaah</th>
                            <th class="py-3 px-6 text-sm font-semibold text-[var(--color-muted)]">Kurban Pilihan</th>
                            <th class="py-3 px-6 text-sm font-semibold text-[var(--color-muted)]">Saldo Terkumpul</th>
                            <th class="py-3 px-6 text-sm font-semibold text-[var(--color-muted)]">Status</th>
                            <th class="py-3 px-6 text-sm font-semibold text-[var(--color-muted)]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--color-border)]">
                        @forelse($jemaahs as $j)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-4 px-6 text-sm font-medium text-[var(--color-on-surface)]">{{ $j->nama_jemaah }}</td>
                            <td class="py-4 px-6 text-sm text-[var(--color-muted)]">{{ $j->hewanKurban->deskripsi ?? '-' }}</td>
                            <td class="py-4 px-6 text-sm font-bold text-[var(--color-on-surface)]">Rp {{ number_format($j->total_saldo, 0, ',', '.') }}</td>
                            <td class="py-4 px-6">
                                <span class="bg-[var(--color-primary)] bg-opacity-10 text-[var(--color-primary)] px-3 py-1 rounded-full text-xs font-bold">{{ $j->status }}</span>
                            </td>
                            <td class="py-4 px-6 text-sm flex gap-2">
                                <button class="text-[var(--color-primary)] hover:underline" onclick="alert('Detail jemaah.')">Detail</button>
                                <button class="text-[var(--color-error)] hover:underline" onclick="alert('Simulasi: Jemaah dibatalkan dan dihapus dari slot agar bisa diganti orang lain.')">Batal Tabung</button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="py-6 text-center text-[var(--color-muted)]">Belum ada jemaah.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- 4. Setoran & Keuangan Tab -->
    <div x-show="tab === 'setoran'" x-transition.opacity style="display: none;">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Kolom Setoran -->
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-[var(--color-on-surface)]">Input Setoran</h2>
                </div>
                
                <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] shadow-sm p-6 mb-6">
                    <form onsubmit="event.preventDefault(); alert('Simulasi form submit setoran berhasil!');">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Pilih Jemaah</label>
                                <select class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-sm">
                                    @foreach($jemaahs as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jemaah }} - Saldo: Rp {{ number_format($j->total_saldo, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Nominal Setoran (Rp)</label>
                                <input type="number" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-sm" placeholder="Contoh: 500000">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Tanggal Setor</label>
                                <input type="date" required value="{{ date('Y-m-d') }}" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-sm">
                            </div>
                            <button type="submit" class="w-full py-3 px-4 rounded-[4px] shadow-sm text-sm font-bold text-white bg-[var(--color-primary)] hover:bg-blue-700 transition">Simpan Setoran</button>
                        </div>
                    </form>
                </div>
                
                <h3 class="text-lg font-bold text-[var(--color-on-surface)] mb-4">Riwayat Setoran</h3>
                <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] shadow-sm overflow-hidden">
                    <ul class="divide-y divide-[var(--color-border)]">
                        @foreach($setorans as $setoran)
                        <li class="p-4 flex justify-between items-center hover:bg-gray-50">
                            <div>
                                <p class="font-semibold text-sm text-[var(--color-on-surface)]">{{ $setoran->jemaah->nama_jemaah }}</p>
                                <p class="text-xs text-[var(--color-muted)]">{{ \Carbon\Carbon::parse($setoran->tanggal_setor)->translatedFormat('d M Y') }}</p>
                            </div>
                            <span class="font-bold text-[var(--color-success)]">+ Rp {{ number_format($setoran->nominal, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            
            <!-- Kolom Pengeluaran -->
            <div>
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold text-[var(--color-on-surface)]">Catat Pengeluaran</h2>
                </div>
                
                <div class="bg-red-50 border border-red-200 p-4 rounded-[4px] text-sm font-medium text-red-800 mb-6">
                    Penting: Semua pengeluaran di sini akan langsung tampil secara transparan di Dasbor Jemaah sesuai PRD v1.1.
                </div>
                
                <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] shadow-sm p-6 mb-6">
                    <form onsubmit="event.preventDefault(); alert('Simulasi form submit pengeluaran berhasil!');">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Pengeluaran Untuk Hewan</label>
                                <select class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-sm">
                                    @foreach($hewanKurbans as $h)
                                        <option value="{{ $h->id }}">{{ $h->deskripsi }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Nama/Deskripsi Pengeluaran</label>
                                <input type="text" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-sm" placeholder="Contoh: DP Sapi, Beli Plastik">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Nominal (Rp)</label>
                                <input type="number" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] text-sm" placeholder="Contoh: 1500000">
                            </div>
                            <button type="submit" class="w-full py-3 px-4 rounded-[4px] shadow-sm text-sm font-bold text-white bg-[var(--color-error)] hover:bg-red-700 transition">Catat Pengeluaran</button>
                        </div>
                    </form>
                </div>
                
                <h3 class="text-lg font-bold text-[var(--color-on-surface)] mb-4">Riwayat Pengeluaran</h3>
                <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] shadow-sm overflow-hidden">
                    <ul class="divide-y divide-[var(--color-border)]">
                        @foreach($pengeluarans as $pengeluaran)
                        <li class="p-4 flex justify-between items-center hover:bg-gray-50">
                            <div>
                                <p class="font-semibold text-sm text-[var(--color-on-surface)]">{{ $pengeluaran->nama_pengeluaran }}</p>
                                <p class="text-xs text-[var(--color-muted)]">Untuk: {{ $pengeluaran->hewanKurban->deskripsi }}</p>
                            </div>
                            <span class="font-bold text-[var(--color-error)]">- Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection

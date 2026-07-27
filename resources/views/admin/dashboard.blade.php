@extends('layouts.dashboard-mitra')

@section('title', 'Dashboard Admin - Sylvan Kurban')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12" x-data="{ tab: 'overview' }">
    
    <div class="mb-10 animate-hero">
        <h1 class="text-4xl font-display font-medium text-[var(--color-secondary)]">Dashboard Pengurus</h1>
        <p class="text-[var(--color-text-secondary)] font-body mt-2">Masjid: <span class="font-bold text-[var(--color-secondary)]">{{ $masjid->name ?? 'Belum Diatur' }}</span></p>
    </div>

    @if(session('success'))
        <div class="bg-[var(--color-success)] text-white p-4 rounded-md mb-6 font-body animate-hero">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-[var(--color-error)] text-white p-4 rounded-md mb-6 font-body animate-hero">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-[var(--color-error)] text-white p-4 rounded-md mb-6 font-body animate-hero">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
            
            <button @click="tab = 'riwayat'" 
                    :class="{'border-[var(--color-accent)] text-[var(--color-secondary)]': tab === 'riwayat', 'border-transparent text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:border-[var(--color-border)]': tab !== 'riwayat'}" 
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-display font-medium text-sm transition uppercase tracking-wider">
                Riwayat Transaksi
            </button>
            
            <button @click="tab = 'profil'" 
                    :class="{'border-[var(--color-accent)] text-[var(--color-secondary)]': tab === 'profil', 'border-transparent text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:border-[var(--color-border)]': tab !== 'profil'}" 
                    class="whitespace-nowrap py-4 px-1 border-b-2 font-display font-medium text-sm transition uppercase tracking-wider">
                Profil Masjid
            </button>
        </nav>
    </div>

    <!-- Tab Contents -->
    
    <!-- 1. Overview Tab -->
    <div x-show="tab === 'overview'" x-transition.opacity>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <x-card class="animate-card bg-white border-[var(--color-border)] shadow-sm">
                <p class="text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2 uppercase tracking-wider">Saldo Kas Saat Ini</p>
                <p class="text-4xl font-display font-bold text-[var(--color-secondary)]">Rp {{ number_format($totalSaldoTerkumpul, 0, ',', '.') }}</p>
                <p class="text-xs text-[var(--color-text-secondary)] mt-2 font-body">*Total Pemasukan dikurangi Pengeluaran</p>
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
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            <!-- Setoran Terbaru -->
            <x-card class="p-0 overflow-hidden animate-card">
                <div class="p-6 border-b border-[var(--color-border)] flex justify-between items-center bg-[#e3e8e0]">
                    <h3 class="font-display font-bold text-[var(--color-secondary)]">Setoran Terbaru</h3>
                    <button @click="tab = 'riwayat'" class="text-sm font-mono text-[var(--color-accent)] font-semibold hover:underline">LIHAT RIWAYAT</button>
                </div>
                <div class="p-0">
                    <table class="w-full text-left border-collapse">
                        <tbody class="divide-y divide-[var(--color-border)] font-body">
                            @forelse($setorans->take(5) as $setoran)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-6 font-display font-medium text-[var(--color-secondary)]">{{ $setoran->jemaah->nama_jemaah }}</td>
                                <td class="py-4 px-6 text-sm font-mono text-[var(--color-text-secondary)]">{{ \Carbon\Carbon::parse($setoran->tanggal_setor)->translatedFormat('d M') }}</td>
                                <td class="py-4 px-6 font-mono font-bold text-[var(--color-success)] text-right">+Rp {{ number_format($setoran->nominal_setor, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-8 px-6 text-center text-[var(--color-text-secondary)]">Belum ada setoran masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>

            <!-- Pengeluaran Terbaru -->
            <x-card class="p-0 overflow-hidden animate-card">
                <div class="p-6 border-b border-[var(--color-border)] flex justify-between items-center bg-[#fdf2f2]">
                    <h3 class="font-display font-bold text-[var(--color-secondary)]">Pengeluaran Terbaru</h3>
                    <button @click="tab = 'riwayat'" class="text-sm font-mono text-[var(--color-accent)] font-semibold hover:underline">LIHAT RIWAYAT</button>
                </div>
                <div class="p-0">
                    <table class="w-full text-left border-collapse">
                        <tbody class="divide-y divide-[var(--color-border)] font-body">
                            @forelse($pengeluarans->take(5) as $pengeluaran)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-6 font-display font-medium text-[var(--color-secondary)]">
                                    {{ $pengeluaran->nama_pengeluaran }}
                                    <div class="text-xs text-[var(--color-text-secondary)]">{{ $pengeluaran->hewanKurban->jenis_hewan ?? '-' }}</div>
                                </td>
                                <td class="py-4 px-6 text-sm font-mono text-[var(--color-text-secondary)]">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->translatedFormat('d M') }}</td>
                                <td class="py-4 px-6 font-mono font-bold text-[var(--color-error)] text-right">-Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-8 px-6 text-center text-[var(--color-text-secondary)]">Belum ada pengeluaran dicatat.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </x-card>
        </div>
    </div>
    
    <!-- 2. Hewan Kurban Tab -->
    <div x-show="tab === 'hewan'" x-transition.opacity style="display: none;" x-data="{ showFormHewan: false }">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)]">Daftar Hewan Kurban</h2>
            <x-button variant="primary" @click="showFormHewan = !showFormHewan" x-text="showFormHewan ? 'Batal Tambah' : '+ Tambah Hewan'"></x-button>
        </div>
        
        <!-- Form Tambah Hewan Kurban -->
        <div x-show="showFormHewan" x-collapse class="mb-8">
            <x-card class="bg-white border-[var(--color-border)]">
                <h3 class="font-display font-bold text-lg text-[var(--color-secondary)] mb-4 border-b pb-2">Form Tambah Hewan Kurban</h3>
                <form action="{{ route('admin.hewan.store') }}" method="POST">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">JENIS HEWAN</label>
                            <select name="jenis_hewan" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                                <option value="Sapi">Sapi</option>
                                <option value="Kambing">Kambing</option>
                                <option value="Domba">Domba</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">NAMA PAKET / DESKRIPSI</label>
                            <input type="text" name="deskripsi" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body" placeholder="Sapi Tipe A (Limousin)">
                        </div>
                        <div>
                            <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">TOTAL HARGA (RP)</label>
                            <input type="number" name="harga_total" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono" placeholder="25000000">
                        </div>
                        <div>
                            <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">KAPASITAS SLOT JEMAAH</label>
                            <input type="number" name="kapasitas_slot" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono" placeholder="7">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">TARGET TABUNGAN PER SLOT (RP)</label>
                            <input type="number" name="target_per_slot" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono" placeholder="3571500">
                            <p class="text-xs text-[var(--color-text-secondary)] mt-1 font-body">Opsional: Biaya yang dibebankan per orang (Harga Total dibagi Kapasitas).</p>
                        </div>
                    </div>
                    <div class="flex justify-end">
                        <x-button type="submit" variant="secondary">Simpan Hewan</x-button>
                    </div>
                </form>
            </x-card>
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
                
                <x-card class="bg-white border-[var(--color-border)]">
                    <form action="{{ route('admin.setoran.store') }}" method="POST">
                        @csrf
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">PILIH JEMAAH</label>
                                <select name="jemaah_id" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                                    <option value="" disabled selected>-- Pilih Jemaah --</option>
                                    @foreach($jemaahs as $j)
                                        <option value="{{ $j->id }}">{{ $j->nama_jemaah }} - Saldo: Rp {{ number_format($j->total_saldo, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">NOMINAL SETORAN (RP)</label>
                                <input type="number" name="nominal" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono" placeholder="500000">
                            </div>
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">TANGGAL SETOR</label>
                                <input type="date" name="tanggal_setor" required value="{{ date('Y-m-d') }}" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono">
                            </div>
                            <x-button variant="secondary" type="submit" class="w-full justify-center">Catat Setoran</x-button>
                        </div>
                    </form>
                </x-card>
            </div>
            
            <!-- Kolom Pengeluaran -->
            <div class="animate-card">
                <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-6">Catat Pengeluaran</h2>
                
                <x-card class="bg-white border-[var(--color-border)]">
                    <form action="{{ route('admin.pengeluaran.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">PILIH HEWAN (ALOKASI)</label>
                                <select name="hewan_kurban_id" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                                    <option value="" disabled selected>-- Pilih Hewan --</option>
                                    @foreach($hewanKurbans as $h)
                                        <option value="{{ $h->id }}">{{ $h->jenis_hewan }} ({{ $h->deskripsi }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">NAMA PENGELUARAN</label>
                                <input type="text" name="nama_pengeluaran" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body" placeholder="Misal: Biaya Pakan / Pemeliharaan">
                            </div>
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">NOMINAL (RP)</label>
                                <input type="number" name="nominal" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono" placeholder="50000">
                            </div>
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">TANGGAL</label>
                                <input type="date" name="tanggal" required value="{{ date('Y-m-d') }}" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono">
                            </div>
                            <x-button variant="primary" type="submit" class="w-full justify-center">Simpan Pengeluaran</x-button>
                        </div>
                    </form>
                </x-card>
            </div>
        </div>
    </div>
    
    <!-- Riwayat Transaksi Tab -->
    <div x-show="tab === 'riwayat'" x-transition.opacity style="display: none;" 
         x-data="{
             transactions: {{ json_encode($riwayatTransaksi) }},
             sortCol: 'timestamp',
             sortAsc: false,
             filterType: 'Semua',
             showFilterModal: false,
             get filteredTransactions() {
                 let result = this.transactions;
                 if (this.filterType !== 'Semua') {
                     result = result.filter(t => t.tipe === this.filterType);
                 }
                 result = result.sort((a, b) => {
                     let valA = a[this.sortCol];
                     let valB = b[this.sortCol];
                     if (valA < valB) return this.sortAsc ? -1 : 1;
                     if (valA > valB) return this.sortAsc ? 1 : -1;
                     return 0;
                 });
                 return result;
             },
             sortBy(col) {
                 if (this.sortCol === col) {
                     this.sortAsc = !this.sortAsc;
                 } else {
                     this.sortCol = col;
                     this.sortAsc = true;
                 }
             },
             formatRupiah(number) {
                 return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
             }
         }">
         
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)]">Riwayat Transaksi</h2>
            <button @click="showFilterModal = true" class="flex items-center space-x-2 bg-white border border-[var(--color-border)] px-4 py-2 rounded-md shadow-sm hover:bg-gray-50 transition text-sm font-mono text-[var(--color-secondary)]">
                <i class="fa-solid fa-filter"></i>
                <span x-text="'Filter: ' + filterType"></span>
            </button>
        </div>

        <x-card class="p-0 overflow-hidden bg-white border-[var(--color-border)] shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#e3e8e0] border-b border-[var(--color-border)] cursor-pointer select-none">
                            <th @click="sortBy('id')" class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider hover:text-[var(--color-secondary)] transition">
                                ID TRX <span x-show="sortCol === 'id'" x-text="sortAsc ? '▲' : '▼'" class="ml-1"></span>
                            </th>
                            <th @click="sortBy('timestamp')" class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider hover:text-[var(--color-secondary)] transition">
                                TANGGAL <span x-show="sortCol === 'timestamp'" x-text="sortAsc ? '▲' : '▼'" class="ml-1"></span>
                            </th>
                            <th @click="sortBy('tipe')" class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider hover:text-[var(--color-secondary)] transition">
                                TIPE <span x-show="sortCol === 'tipe'" x-text="sortAsc ? '▲' : '▼'" class="ml-1"></span>
                            </th>
                            <th @click="sortBy('keterangan')" class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider hover:text-[var(--color-secondary)] transition">
                                KETERANGAN <span x-show="sortCol === 'keterangan'" x-text="sortAsc ? '▲' : '▼'" class="ml-1"></span>
                            </th>
                            <th @click="sortBy('nominal')" class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider hover:text-[var(--color-secondary)] transition text-right">
                                NOMINAL <span x-show="sortCol === 'nominal'" x-text="sortAsc ? '▲' : '▼'" class="ml-1"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[var(--color-border)] font-body">
                        <template x-for="trx in filteredTransactions" :key="trx.id">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-4 px-6 text-sm font-mono text-[var(--color-text-secondary)]" x-text="trx.id"></td>
                                <td class="py-4 px-6 text-sm font-mono text-[var(--color-text-secondary)]" x-text="trx.tanggal"></td>
                                <td class="py-4 px-6">
                                    <span :class="{'bg-[#e3e8e0] text-[var(--color-accent)]': trx.tipe === 'Pemasukan', 'bg-[#fdf2f2] text-[var(--color-error)]': trx.tipe === 'Pengeluaran'}" 
                                          class="px-2 py-1 rounded text-xs font-mono font-bold" x-text="trx.tipe"></span>
                                </td>
                                <td class="py-4 px-6 font-display font-medium text-[var(--color-secondary)]" x-text="trx.keterangan"></td>
                                <td class="py-4 px-6 font-mono font-bold text-right" 
                                    :class="{'text-[var(--color-success)]': trx.tipe === 'Pemasukan', 'text-[var(--color-error)]': trx.tipe === 'Pengeluaran'}" 
                                    x-text="(trx.tipe === 'Pemasukan' ? '+' : '-') + formatRupiah(trx.nominal)"></td>
                            </tr>
                        </template>
                        <tr x-show="filteredTransactions.length === 0">
                            <td colspan="5" class="py-10 text-center font-body text-[var(--color-text-secondary)]">Tidak ada transaksi yang sesuai.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </x-card>

        <!-- Filter Modal -->
        <div x-show="showFilterModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm">
            <div @click.away="showFilterModal = false" class="bg-white rounded-xl shadow-2xl p-6 w-full max-w-sm">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-display font-bold text-lg text-[var(--color-secondary)]">Filter Transaksi</h3>
                    <button @click="showFilterModal = false" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-times"></i></button>
                </div>
                <div class="space-y-3">
                    <label class="flex items-center space-x-3 cursor-pointer p-3 border rounded-lg hover:bg-gray-50" :class="{'border-[var(--color-accent)] bg-[#e3e8e0]/30': filterType === 'Semua'}">
                        <input type="radio" x-model="filterType" value="Semua" class="text-[var(--color-accent)] focus:ring-[var(--color-accent)]">
                        <span class="font-body text-[var(--color-secondary)]">Semua Transaksi</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer p-3 border rounded-lg hover:bg-gray-50" :class="{'border-[var(--color-accent)] bg-[#e3e8e0]/30': filterType === 'Pemasukan'}">
                        <input type="radio" x-model="filterType" value="Pemasukan" class="text-[var(--color-accent)] focus:ring-[var(--color-accent)]">
                        <span class="font-body text-[var(--color-secondary)]">Hanya Pemasukan (Setoran)</span>
                    </label>
                    <label class="flex items-center space-x-3 cursor-pointer p-3 border rounded-lg hover:bg-gray-50" :class="{'border-[var(--color-accent)] bg-[#e3e8e0]/30': filterType === 'Pengeluaran'}">
                        <input type="radio" x-model="filterType" value="Pengeluaran" class="text-[var(--color-accent)] focus:ring-[var(--color-accent)]">
                        <span class="font-body text-[var(--color-secondary)]">Hanya Pengeluaran</span>
                    </label>
                </div>
                <div class="mt-6">
                    <x-button @click="showFilterModal = false" variant="primary" class="w-full justify-center">Terapkan Filter</x-button>
                </div>
            </div>
        </div>
    </div>
    <!-- 5. Profil Masjid Tab -->
    <div x-show="tab === 'profil'" x-transition.opacity style="display: none;">
        <div class="max-w-6xl">
            <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mb-6">Profil Masjid</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Data Pokok Masjid -->
                <x-card class="bg-white border-[var(--color-border)]">
                    <h3 class="font-display font-bold text-lg text-[var(--color-secondary)] mb-4 border-b pb-2">Informasi Profil</h3>
                    <form action="{{ route('admin.masjid.profil.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">NAMA MASJID</label>
                                <input type="text" name="name" value="{{ old('name', $masjid->name) }}" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">ALAMAT LENGKAP</label>
                                <textarea name="address" rows="3" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">{{ old('address', $masjid->address) }}</textarea>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">KOTA/KABUPATEN</label>
                                <input type="text" name="city" value="{{ old('city', $masjid->city) }}" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                            </div>

                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">DESKRIPSI / INFO SINGKAT</label>
                                <textarea name="deskripsi" rows="3" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body" placeholder="Misal: Visi masjid, jadwal kegiatan, dll">{{ old('deskripsi', $masjid->deskripsi) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">KONTAK PERSON (WA/HP)</label>
                                <input type="text" name="kontak_person" value="{{ old('kontak_person', $masjid->kontak_person) }}" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body" placeholder="08123456789">
                            </div>
                            
                            <div class="pt-4 border-t border-[var(--color-border)]">
                                <x-button type="submit" variant="primary" class="w-full justify-center">Simpan Profil</x-button>
                            </div>
                        </div>
                    </form>
                </x-card>

                <!-- Rekening dan Gambar -->
                <div class="space-y-8">
                    <!-- Foto Masjid -->
                    <x-card class="bg-white border-[var(--color-border)]">
                        <h3 class="font-display font-bold text-lg text-[var(--color-secondary)] mb-4 border-b pb-2">Foto Masjid</h3>
                        
                        @if($masjid->gambar)
                            <div class="mb-4 rounded-xl overflow-hidden shadow-sm">
                                <img src="{{ str_starts_with($masjid->gambar, 'http') ? $masjid->gambar : asset('storage/' . $masjid->gambar) }}" alt="Foto Masjid" class="w-full h-48 object-cover">
                            </div>
                            <form action="{{ route('admin.masjid.image.remove') }}" method="POST" class="mb-6">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" variant="danger" class="w-full justify-center py-2 text-sm">Hapus Gambar</x-button>
                            </form>
                        @endif
                        
                        <form action="{{ route('admin.masjid.image.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">UPLOAD FOTO (OPSIONAL)</label>
                                    <input type="file" name="image_file" accept="image/*" class="block w-full text-sm text-[var(--color-text-secondary)] file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[var(--color-accent)] file:text-white hover:file:bg-[var(--color-secondary)] cursor-pointer">
                                </div>
                                <div class="text-center text-sm text-[var(--color-text-secondary)]">- ATAU -</div>
                                <div>
                                    <label class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2">LINK GAMBAR/URL (OPSIONAL)</label>
                                    <input type="url" name="image_url" placeholder="https://example.com/image.jpg" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                                </div>
                                <x-button type="submit" variant="secondary" class="w-full justify-center">Perbarui Foto</x-button>
                            </div>
                        </form>
                    </x-card>

                    <!-- Informasi Rekening -->
                    <x-card class="bg-white border-[var(--color-border)]">
                        <h3 class="font-display font-bold text-lg text-[var(--color-secondary)] mb-4 border-b pb-2">Informasi Rekening & Pembayaran</h3>
                        
                        @if($masjid->rekenings && $masjid->rekenings->count() > 0)
                            <div class="mb-6 space-y-3">
                                @foreach($masjid->rekenings as $rek)
                                    <div x-data="{ editMode: false }" class="p-3 border border-[var(--color-border)] rounded bg-[var(--color-primary)]">
                                        
                                        <!-- Display Mode -->
                                        <div x-show="!editMode" class="flex justify-between items-start">
                                            <div>
                                                <div class="font-bold text-[var(--color-secondary)]">{{ $rek->platform }}</div>
                                                <div class="font-mono text-sm">{{ $rek->nomor_rekening }}</div>
                                                <div class="text-sm text-[var(--color-text-secondary)]">a.n. {{ $rek->atas_nama }}</div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <button type="button" @click="editMode = true" class="text-xs text-[var(--color-accent)] hover:underline">Edit</button>
                                                <form action="{{ route('admin.masjid.rekening.destroy', $rek->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Hapus metode pembayaran ini?')" class="text-xs text-[var(--color-error)] hover:underline">Hapus</button>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Edit Mode -->
                                        <div x-show="editMode" style="display: none;" class="mt-2 pt-2 border-t border-[var(--color-border)]">
                                            <form action="{{ route('admin.masjid.rekening.update', $rek->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="space-y-2">
                                                    <input type="text" name="platform" value="{{ $rek->platform }}" required class="appearance-none block w-full px-3 py-2 border border-[var(--color-border)] rounded-[4px] bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                                                    <input type="text" name="nomor_rekening" value="{{ $rek->nomor_rekening }}" required class="appearance-none block w-full px-3 py-2 border border-[var(--color-border)] rounded-[4px] bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono">
                                                    <input type="text" name="atas_nama" value="{{ $rek->atas_nama }}" required class="appearance-none block w-full px-3 py-2 border border-[var(--color-border)] rounded-[4px] bg-white text-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                                                    
                                                    <div class="flex space-x-2 pt-2">
                                                        <x-button type="submit" variant="primary" class="text-xs py-1">Simpan</x-button>
                                                        <button type="button" @click="editMode = false" class="text-xs text-[var(--color-text-secondary)] hover:underline">Batal</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="mb-6 p-4 bg-yellow-50 text-yellow-700 rounded text-sm font-body border border-yellow-200">
                                Belum ada informasi pembayaran. Tambahkan rekening bank atau dompet digital agar Jemaah tahu ke mana harus menyetor.
                            </div>
                        @endif

                        <h4 class="font-mono font-semibold text-sm mb-3">Tambah Metode Pembayaran</h4>
                        <form action="{{ route('admin.masjid.rekening.store') }}" method="POST">
                            @csrf
                            <div class="space-y-3">
                                <div>
                                    <input type="text" name="platform" required placeholder="Bank / Platform (Misal: BSI, GoPay, Dana)" class="appearance-none block w-full px-3 py-2 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                                </div>
                                <div>
                                    <input type="text" name="nomor_rekening" required placeholder="Nomor Rekening / No HP" class="appearance-none block w-full px-3 py-2 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-mono">
                                </div>
                                <div>
                                    <input type="text" name="atas_nama" required placeholder="Atas Nama (Misal: Masjid Al-Barkah)" class="appearance-none block w-full px-3 py-2 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-sm focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] font-body">
                                </div>
                                <x-button type="submit" variant="primary" class="w-full justify-center text-sm py-2">Tambah Rekening</x-button>
                            </div>
                        </form>
                    </x-card>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

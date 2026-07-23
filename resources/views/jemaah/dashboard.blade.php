@extends('layouts.app')

@section('title', 'Dashboard Jemaah - Tabungan Kurban')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="bg-[var(--color-tertiary)] border border-[var(--color-border)] p-6 rounded-[8px] mb-8 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-[var(--color-on-surface)]">Assalamu'alaikum, {{ $jemaah->nama_jemaah }}!</h2>
            <p class="text-[var(--color-muted)] mt-1 flex items-center gap-1">
                📍 {{ $jemaah->masjid->name }} • Slot {{ $jemaah->hewanKurban->deskripsi }}
            </p>
        </div>
        <div class="w-12 h-12 rounded-full bg-[var(--color-primary)] bg-opacity-10 text-[var(--color-primary)] flex items-center justify-center font-bold text-xl border border-[var(--color-primary)]">
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
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] p-8 shadow-sm text-center flex flex-col items-center justify-center">
            <h3 class="text-lg font-semibold text-[var(--color-on-surface)] mb-4">Progress Tabungan</h3>
            
            <div class="relative w-40 h-40">
                <svg class="w-full h-full" viewBox="0 0 100 100">
                    <circle class="text-[var(--color-tertiary)] stroke-current" stroke-width="8" cx="50" cy="50" r="40" fill="transparent"></circle>
                    <circle class="text-[var(--color-primary)] stroke-current" stroke-width="8" stroke-linecap="round" cx="50" cy="50" r="40" fill="transparent" stroke-dasharray="{{ 2 * 3.14159 * 40 }}" stroke-dashoffset="{{ (2 * 3.14159 * 40) - ((2 * 3.14159 * 40) * $progress) / 100 }}" transform="rotate(-90 50 50)"></circle>
                </svg>
                <div class="absolute inset-0 flex items-center justify-center flex-col">
                    <span class="text-3xl font-bold text-[var(--color-on-surface)]">{{ $progress }}%</span>
                </div>
            </div>
            
            <p class="mt-4 text-[var(--color-muted)] font-medium">Terkumpul: Rp {{ number_format($terkumpul, 0, ',', '.') }}</p>
        </div>
        
        <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] p-8 shadow-sm flex flex-col justify-center">
            <h3 class="text-lg font-semibold text-[var(--color-on-surface)] mb-2">Sisa Tagihan</h3>
            <p class="text-4xl font-bold text-[var(--color-error)] mb-2">Rp {{ number_format($sisa, 0, ',', '.') }}</p>
            <p class="text-[var(--color-muted)] text-sm mb-6">Target: Rp {{ number_format($target, 0, ',', '.') }}</p>
            
            @if($sisa > 0)
                <div class="bg-red-50 border border-red-200 text-[var(--color-error)] p-4 rounded-[4px] text-sm font-medium">
                    ⚠️ Jatuh tempo pelunasan 14 Hari Sebelum Idul Adha. Harap segera melunasi agar slot tidak digantikan.
                </div>
            @else
                <div class="bg-emerald-50 border border-emerald-200 text-[var(--color-success)] p-4 rounded-[4px] text-sm font-medium">
                    ✅ Alhamdulillah, tabungan Anda sudah lunas. Semoga menjadi amal jariyah.
                </div>
            @endif
        </div>
    </div>
    
    <!-- Riwayat Setoran -->
    <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] shadow-sm mb-12 overflow-hidden">
        <div class="p-6 border-b border-[var(--color-border)]">
            <h3 class="text-lg font-bold text-[var(--color-on-surface)]">Riwayat Setoran</h3>
        </div>
        
        @if($setorans->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[var(--color-tertiary)] border-b border-[var(--color-border)]">
                            <th class="py-3 px-6 text-sm font-semibold text-[var(--color-muted)]">Tanggal</th>
                            <th class="py-3 px-6 text-sm font-semibold text-[var(--color-muted)]">Jumlah Setoran</th>
                            <th class="py-3 px-6 text-sm font-semibold text-[var(--color-muted)]">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($setorans as $setoran)
                        <tr class="border-b border-[var(--color-border)] hover:bg-gray-50 transition">
                            <td class="py-4 px-6 text-sm text-[var(--color-on-surface)]">{{ \Carbon\Carbon::parse($setoran->tanggal_setor)->translatedFormat('d F Y') }}</td>
                            <td class="py-4 px-6 font-medium text-[var(--color-on-surface)]">Rp {{ number_format($setoran->nominal, 0, ',', '.') }}</td>
                            <td class="py-4 px-6">
                                <span class="bg-[var(--color-success)] bg-opacity-10 text-[var(--color-success)] px-3 py-1 rounded-full text-xs font-bold">Diterima</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-8 text-center text-[var(--color-muted)]">
                Belum ada riwayat setoran.
            </div>
        @endif
    </div>

    <!-- Transparansi Pengeluaran -->
    <div class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] shadow-sm overflow-hidden mb-12">
        <div class="p-6 border-b border-[var(--color-border)] bg-[var(--color-tertiary)]">
            <h3 class="text-lg font-bold text-[var(--color-on-surface)]">Transparansi Pengeluaran Kurban</h3>
            <p class="text-[var(--color-muted)] text-sm mt-1">Laporan penggunaan dana khusus untuk {{ $jemaah->hewanKurban->deskripsi }}. Transparan dan dapat dipercaya.</p>
        </div>
        
        @if($pengeluarans->count() > 0)
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($pengeluarans as $pengeluaran)
                    <div class="flex justify-between items-center p-4 border border-[var(--color-border)] rounded-[8px] hover:shadow-sm transition bg-[var(--color-surface)]">
                        <div>
                            <p class="font-semibold text-[var(--color-on-surface)]">{{ $pengeluaran->nama_pengeluaran }}</p>
                            <p class="text-xs text-[var(--color-muted)]">{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->translatedFormat('d F Y') }}</p>
                        </div>
                        <div class="font-bold text-[var(--color-error)]">
                            - Rp {{ number_format($pengeluaran->nominal, 0, ',', '.') }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="p-8 text-center text-[var(--color-muted)]">
                Belum ada catatan pengeluaran dari panitia.
            </div>
        @endif
    </div>
</div>
@endsection

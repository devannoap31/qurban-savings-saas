@extends('layouts.app')

@section('title', 'Portal Jemaah - Tabungan Kurban')

@section('content')
<div class="bg-[var(--color-primary)] text-white py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-6 tracking-tight">Siapkan Kurban Anda Lebih Awal</h1>
        <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto mb-10">Pilih masjid terdekat, pilih slot kurban, dan mulailah menabung dengan mudah dan transparan.</p>
        
        <form action="{{ route('home') }}" method="GET" class="max-w-xl mx-auto">
            <div class="flex">
                <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari masjid atau kota..." class="w-full px-6 py-4 rounded-l-[4px] text-[var(--color-on-surface)] focus:outline-none text- bg-white">
                <button type="submit" class="bg-blue-900 text-white px-8 py-4 rounded-r-[4px] font-semibold hover:bg-blue-800 transition">Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="py-16 bg-[var(--color-surface)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-[var(--color-on-surface)] mb-8">Direktori Masjid Mitra</h2>
        
        @if($masjids->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($masjids as $masjid)
                <div class="bg-[var(--color-tertiary)] border border-[var(--color-border)] rounded-[8px] p-6 hover:shadow-md transition flex flex-col">
                    <h3 class="text-xl font-bold text-[var(--color-on-surface)] mb-2">{{ $masjid->name }}</h3>
                    <p class="text-[var(--color-muted)] text-sm mb-4 line-clamp-2">📍 {{ $masjid->address }}, {{ $masjid->city }}</p>
                    
                    <div class="mt-auto pt-4 border-t border-[var(--color-border)]">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-sm font-medium text-[var(--color-muted)]">Ketersediaan</span>
                            <span class="bg-[var(--color-success)] bg-opacity-10 text-[var(--color-success)] px-3 py-1 rounded-full text-xs font-bold">{{ $masjid->sisa_slot }} Slot Tersedia</span>
                        </div>
                        <a href="#" class="block w-full text-center bg-white border border-[var(--color-border)] text-[var(--color-primary)] font-semibold py-3 rounded-[4px] hover:bg-gray-50 transition">
                            Pilih Slot & Tabung &rarr;
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 bg-[var(--color-tertiary)] rounded-[8px] border border-[var(--color-border)]">
                <p class="text-[var(--color-muted)]">Tidak ada masjid yang ditemukan dengan pencarian "{{ $search }}".</p>
                <a href="{{ route('home') }}" class="text-[var(--color-primary)] font-medium mt-2 inline-block">Lihat Semua Masjid</a>
            </div>
        @endif
    </div>
</div>
@endsection

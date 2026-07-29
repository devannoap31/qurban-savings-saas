@extends('layouts.public-jemaah')

@section('title', 'Daftar Tabungan Kurban - ' . $masjid->name)

@section('content')
<div class="bg-[var(--color-background)] min-h-screen py-16">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8 animate-hero">
            <a href="{{ route('masjids.index') }}" class="inline-flex items-center text-sm font-mono text-[var(--color-text-secondary)] hover:text-[var(--color-accent)] mb-4 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                KEMBALI KE PENCARIAN
            </a>
            <h1 class="text-3xl md:text-4xl font-display font-medium text-[var(--color-secondary)]">Mulai Menabung Kurban</h1>
            <p class="mt-2 text-lg font-body text-[var(--color-text-secondary)]">di <span class="font-bold text-[var(--color-secondary)]">{{ $masjid->name }}</span></p>
        </div>

        @if(session('error'))
            <div class="bg-[var(--color-error)] text-white p-4 rounded-[8px] mb-6 font-body animate-hero">
                {{ session('error') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="bg-[var(--color-error)] text-white p-4 rounded-[8px] mb-6 font-body animate-hero">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-card class="animate-card bg-[var(--color-surface)] border-[var(--color-border)] p-8">
            <form action="{{ route('masjids.daftar.store', $masjid->id) }}" method="POST">
                @csrf
                
                @guest
                <h3 class="text-xl font-display font-bold text-[var(--color-secondary)] mb-6 border-b border-[var(--color-border)] pb-3">Informasi Akun & Data Diri</h3>
                
                <div class="space-y-5 mb-8">
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" required value="{{ old('nama_lengkap') }}" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body transition-shadow">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2 uppercase tracking-wider">Alamat Email</label>
                        <input type="email" name="email" id="email" required value="{{ old('email') }}" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body transition-shadow">
                    </div>

                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2 uppercase tracking-wider">Kata Sandi</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" id="password" required minlength="8" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body transition-shadow pr-10">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm font-mono text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] focus:outline-none">
                                <span x-text="show ? 'SEMBUNYIKAN' : 'TAMPILKAN'">TAMPILKAN</span>
                            </button>
                        </div>
                        <p class="text-xs text-[var(--color-text-secondary)] mt-1 font-body">Minimal 8 karakter.</p>
                    </div>

                    <div x-data="{ show: false }">
                        <label for="password_confirmation" class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-2 uppercase tracking-wider">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" required minlength="8" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body transition-shadow pr-10">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm font-mono text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] focus:outline-none">
                                <span x-text="show ? 'SEMBUNYIKAN' : 'TAMPILKAN'">TAMPILKAN</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endguest

                <h3 class="text-xl font-display font-bold text-[var(--color-secondary)] mb-6 border-b border-[var(--color-border)] pb-3">Pilihan Hewan Kurban</h3>
                
                <div class="space-y-4 mb-8">
                    @if($masjid->hewanKurbans->count() > 0)
                        @foreach($masjid->hewanKurbans as $hewan)
                            @php
                                $isPenuh = $hewan->slot_terisi >= $hewan->kapasitas_slot;
                                $isSelected = request('hewan') == $hewan->id;
                            @endphp
                            <label class="relative block bg-[var(--color-surface)] border rounded-lg shadow-sm px-6 py-4 cursor-pointer sm:flex sm:justify-between focus-within:ring-2 focus-within:ring-[var(--color-accent)] {{ $isPenuh ? 'opacity-50 cursor-not-allowed border-[var(--color-border)]' : ($isSelected ? 'border-[var(--color-accent)] ring-1 ring-[var(--color-accent)] bg-[#f4f6f3]' : 'hover:border-[var(--color-accent)] border-[var(--color-border)] transition-colors opacity-75 hover:opacity-100') }}">
                                <input type="radio" name="hewan_kurban_id" value="{{ $hewan->id }}" {{ $isPenuh ? 'disabled' : '' }} {{ $isSelected ? 'checked' : '' }} class="sr-only peer" required>
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <p class="font-display font-bold text-[var(--color-secondary)] text-lg">
                                            {{ $hewan->jenis_hewan }} ({{ $hewan->deskripsi }})
                                        </p>
                                        <div class="font-body text-[var(--color-text-secondary)] mt-1">
                                            <span class="block sm:inline">Harga per slot: <span class="font-mono font-semibold text-[var(--color-secondary)]">Rp {{ number_format($hewan->target_per_slot, 0, ',', '.') }}</span></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-2 sm:mt-0 sm:ml-4 text-sm sm:text-right flex flex-col justify-center">
                                    @if($isPenuh)
                                        <span class="bg-[var(--color-background)] text-[var(--color-text-secondary)] py-1 px-3 rounded-full font-mono text-xs font-bold inline-block w-max">SLOT PENUH</span>
                                    @else
                                        <span class="bg-[#e3e8e0] text-[var(--color-accent)] py-1 px-3 rounded-full font-mono text-xs font-bold inline-block w-max">Tersedia {{ $hewan->kapasitas_slot - $hewan->slot_terisi }} Slot</span>
                                    @endif
                                </div>
                                <!-- Active/Checked border overlay -->
                                <div class="absolute -inset-px rounded-lg pointer-events-none border-2 border-transparent peer-checked:border-[var(--color-accent)]" aria-hidden="true"></div>
                            </label>
                        @endforeach
                    @else
                        <div class="p-4 bg-yellow-50 text-yellow-700 rounded-[8px] text-sm font-body">
                            Mohon maaf, masjid ini belum mendaftarkan slot hewan kurban. Anda belum dapat mendaftar.
                        </div>
                    @endif
                </div>

                <div class="pt-4">
                    <x-button type="submit" variant="primary" class="w-full justify-center py-4 text-lg" :disabled="$masjid->hewanKurbans->count() == 0">
                        @auth
                            Mulai Menabung Kurban Baru
                        @else
                            Daftar dan Buat Akun
                        @endauth
                    </x-button>
                    @guest
                    <p class="text-center text-xs font-body text-[var(--color-text-secondary)] mt-4">
                        Dengan mendaftar, Anda menyetujui <a href="{{ route('pages.syarat') }}" class="text-[var(--color-accent)] hover:underline">Syarat & Ketentuan</a> Sylvan Kurban.
                    </p>
                    @endguest
                </div>
            </form>
        </x-card>
        
    </div>
</div>

<style>
/* Custom radio button styling */
input[type="radio"]:checked + div > div > p {
    color: var(--color-accent);
}
label:has(input[type="radio"]:checked) {
    border-color: var(--color-accent);
    background-color: #f9fbf9;
}
</style>
@endsection

@extends('layouts.app')

@section('title', 'Masuk - Sylvan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <x-card class="max-w-md w-full space-y-8 animate-hero">
        <div class="text-center">
            <h2 class="mt-2 text-3xl md:text-4xl font-display font-medium text-[var(--color-secondary)] tracking-tight leading-[1.04]">
                {{ $is_mitra ? 'Portal Pengurus Masjid' : 'Selamat Datang Kembali' }}
            </h2>
            <p class="mt-3 text-base font-body text-[var(--color-text-secondary)]">
                {{ $is_mitra ? 'Masuk untuk mengelola tabungan jemaah Anda' : 'Masuk untuk melanjutkan ke Dasbor Anda' }}
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ route('login.post') }}" method="POST">
            @csrf
            @if(session('error'))
                <div class="bg-red-50 text-[var(--color-error)] p-4 rounded-[4px] text-sm font-mono border border-red-200">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="space-y-5">
                <div>
                    <label for="email" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Alamat Email</label>
                    <input id="email" name="email" type="email" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                </div>
                <div>
                    <label for="password" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Kata Sandi</label>
                    <input id="password" name="password" type="password" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                </div>
            </div>

            <div>
                <x-button type="submit" variant="secondary" class="w-full justify-center py-3.5">
                    Masuk ke Akun
                </x-button>
            </div>
            
            <div class="text-center mt-6">
                @if($is_mitra)
                    <a href="{{ route('mitra.register') }}" class="text-base font-body text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:underline transition">Masjid Anda belum terdaftar? Ajukan di sini</a>
                @else
                    <a href="{{ route('mitra.login') }}" class="text-base font-body text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:underline transition">Anda Pengurus Masjid? Masuk melalui Portal Mitra</a>
                @endif
            </div>
        </form>
    </x-card>
</div>
@endsection

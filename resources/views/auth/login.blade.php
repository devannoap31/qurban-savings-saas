@extends('layouts.app')

@section('title', 'Masuk - Sylvan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <x-card class="max-w-md w-full space-y-8 animate-hero">
        <div class="text-center">
            <h2 class="mt-2 text-3xl font-display font-bold text-[var(--color-secondary)] tracking-tight">
                Selamat Datang Kembali
            </h2>
            <p class="mt-3 text-sm font-body text-[var(--color-text-secondary)]">
                Masuk untuk melanjutkan ke Dasbor Anda
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
                    <label for="email" class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-1">ALAMAT EMAIL</label>
                    <input id="email" name="email" type="email" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-sm transition-colors">
                </div>
                <div>
                    <label for="password" class="block text-sm font-mono font-semibold text-[var(--color-text-secondary)] mb-1">KATA SANDI</label>
                    <input id="password" name="password" type="password" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-sm transition-colors">
                </div>
            </div>

            <div>
                <x-button type="submit" variant="secondary" class="w-full justify-center py-3.5">
                    Masuk ke Akun
                </x-button>
            </div>
            
            <div class="text-center mt-6">
                <a href="{{ route('mitra.register') }}" class="text-sm font-body text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:underline transition">Pengurus Masjid belum punya akun? Daftar di sini</a>
            </div>
        </form>
    </x-card>
</div>
@endsection

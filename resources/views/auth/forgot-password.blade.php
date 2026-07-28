@extends('layouts.auth')

@section('title', 'Lupa Kata Sandi - Sylvan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <x-card class="max-w-md w-full space-y-8 animate-hero">
        <div class="text-center">
            <h2 class="mt-2 text-3xl md:text-4xl font-display font-medium text-[var(--color-secondary)] tracking-tight leading-[1.04]">
                Lupa Kata Sandi?
            </h2>
            <p class="mt-3 text-base font-body text-[var(--color-text-secondary)]">
                Tidak masalah. Masukkan alamat email Anda, dan kami akan mengirimkan tautan untuk membuat kata sandi baru.
            </p>
        </div>
        
        @if (session('success'))
            <div class="bg-green-50 text-[var(--color-secondary)] p-4 rounded-[4px] text-sm font-mono border border-green-200 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form class="mt-8 space-y-6" action="{{ route('password.email') }}" method="POST">
            @csrf
            
            <div class="space-y-5">
                <div>
                    <label for="email" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Alamat Email Terdaftar</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus class="appearance-none block w-full px-4 py-3 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <x-button type="submit" variant="secondary" class="w-full justify-center py-3.5">
                    Kirim Tautan Reset
                </x-button>
            </div>
            
            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-base font-body text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:underline transition">Kembali ke Halaman Login</a>
            </div>
        </form>
    </x-card>
</div>
@endsection

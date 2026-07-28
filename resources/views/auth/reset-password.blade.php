@extends('layouts.auth')

@section('title', 'Buat Kata Sandi Baru - Sylvan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <x-card class="max-w-md w-full space-y-8 animate-hero">
        <div class="text-center">
            <h2 class="mt-2 text-3xl md:text-4xl font-display font-medium text-[var(--color-secondary)] tracking-tight leading-[1.04]">
                Buat Kata Sandi Baru
            </h2>
            <p class="mt-3 text-base font-body text-[var(--color-text-secondary)]">
                Tuliskan kata sandi baru Anda di bawah ini untuk mengakses kembali akun Anda.
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST" x-data="{ showPassword: false }">
            @csrf
            
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div class="space-y-5">
                <div>
                    <label for="email" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Alamat Email</label>
                    <input id="email" name="email" type="email" value="{{ $email ?? old('email') }}" required readonly class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-[4px] bg-gray-50 text-[var(--color-text-secondary)] focus:outline-none font-body sm:text-base transition-colors cursor-not-allowed">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="password" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Kata Sandi Baru</label>
                    <input id="password" name="password" :type="showPassword ? 'text' : 'password'" required class="appearance-none block w-full px-4 py-3 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                    @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Konfirmasi Kata Sandi Baru</label>
                    <input id="password_confirmation" name="password_confirmation" :type="showPassword ? 'text' : 'password'" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                </div>

                <div class="flex items-center mt-2">
                    <input id="show_password" type="checkbox" x-model="showPassword" class="h-4 w-4 text-[var(--color-accent)] focus:ring-[var(--color-accent)] border-gray-300 rounded">
                    <label for="show_password" class="ml-2 block text-sm font-body text-[var(--color-text-secondary)]">Tampilkan kata sandi</label>
                </div>
            </div>

            <div>
                <x-button type="submit" variant="secondary" class="w-full justify-center py-3.5">
                    Simpan Kata Sandi
                </x-button>
            </div>
        </form>
    </x-card>
</div>
@endsection

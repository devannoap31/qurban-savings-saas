@extends('layouts.auth')

@section('title', 'Masuk - Sylvan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <x-card class="max-w-md w-full space-y-8 animate-hero">
        <div class="text-center">
            <h2 class="mt-2 text-3xl md:text-4xl font-display font-medium text-[var(--color-secondary)] tracking-tight leading-[1.04]">
                {{ $is_superadmin ? 'Login Superadmin' : ($is_mitra ? 'Portal Pengurus Masjid' : 'Selamat Datang Kembali') }}
            </h2>
            <p class="mt-3 text-base font-body text-[var(--color-text-secondary)]">
                {{ $is_superadmin ? 'Masuk ke panel kontrol pusat' : ($is_mitra ? 'Masuk untuk mengelola tabungan jemaah Anda' : 'Masuk untuk melanjutkan ke Dasbor Anda') }}
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ $is_superadmin ? route('superadmin.login.post') : ($is_mitra ? route('mitra.login.post') : route('login.post')) }}" method="POST">
            @csrf
            @if($errors->any())
                <div class="bg-red-50 text-[var(--color-error)] p-4 rounded-[4px] text-sm font-mono border border-red-200">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-50 text-[var(--color-error)] p-4 rounded-[4px] text-sm font-mono border border-red-200">
                    {{ session('error') }}
                </div>
            @endif
            
            <div class="space-y-5">
                <div>
                    <label for="email" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Alamat Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                </div>
                <div x-data="{ show: false }">
                    <div class="flex justify-between items-center mb-1">
                        <label for="password" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] uppercase">Kata Sandi</label>
                        <a href="{{ route('password.request') }}" class="text-xs font-body text-[var(--color-accent)] hover:text-[var(--color-secondary)] hover:underline transition">Lupa Kata Sandi?</a>
                    </div>
                    <div class="relative">
                        <input id="password" name="password" :type="show ? 'text' : 'password'" required class="appearance-none block w-full px-4 py-3 border border-gray-300 rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-gray-500 hover:text-gray-700">
                            <!-- Icon Eye Closed -->
                            <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                            <!-- Icon Eye Open -->
                            <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div>
                <x-button type="submit" variant="secondary" class="w-full justify-center py-3.5">
                    Masuk ke Akun
                </x-button>
            </div>
            
            <div class="text-center mt-6">
                @if($is_superadmin)
                    <a href="{{ route('login') }}" class="text-base font-body text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:underline transition">Kembali ke Halaman Login Utama</a>
                @elseif($is_mitra)
                    <a href="{{ route('mitra.register') }}" class="text-base font-body text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:underline transition">Masjid Anda belum terdaftar? Ajukan di sini</a>
                @else
                    <a href="{{ route('mitra.login') }}" class="text-base font-body text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:underline transition">Anda Pengurus Masjid? Masuk melalui Portal Mitra</a>
                @endif
            </div>
        </form>
    </x-card>
</div>
@endsection

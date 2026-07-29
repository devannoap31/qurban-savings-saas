@extends('layouts.dashboard-superadmin')

@section('title', 'Pengaturan Profil - Superadmin')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="mb-10 animate-hero">
        <span class="inline-block px-3 py-1 bg-[#e3e8e0] text-[var(--color-accent)] text-xs font-mono rounded-full mb-3">PENGATURAN</span>
        <h1 class="text-4xl font-display font-medium text-[var(--color-secondary)]">Profil Superadmin</h1>
        <p class="text-[var(--color-text-secondary)] font-body mt-2">Perbarui informasi dasar profil dan kata sandi Anda.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-[4px] text-sm font-mono border border-green-200 animate-hero">
            {{ session('success') }}
        </div>
    @endif

    <x-card class="animate-card border border-[var(--color-border)]">
        <form action="{{ route('superadmin.profil.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="name" class="block text-sm font-bold text-[var(--color-secondary)] font-mono mb-2 uppercase tracking-wider">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] shadow-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[var(--color-accent)] focus:border-[var(--color-accent)] sm:text-sm transition bg-[var(--color-background)] focus:bg-[var(--color-surface)]" required>
                @error('name') <p class="mt-2 text-sm text-red-600 font-mono">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-bold text-[var(--color-secondary)] font-mono mb-2 uppercase tracking-wider">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] shadow-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[var(--color-accent)] focus:border-[var(--color-accent)] sm:text-sm transition bg-[var(--color-background)] focus:bg-[var(--color-surface)]" required>
                @error('email') <p class="mt-2 text-sm text-red-600 font-mono">{{ $message }}</p> @enderror
            </div>

            <div class="pt-6 border-t border-[var(--color-border)]">
                <h3 class="text-lg font-display font-medium text-[var(--color-secondary)] mb-4">Ganti Kata Sandi</h3>
                <p class="text-sm font-body text-[var(--color-text-secondary)] mb-6">Biarkan kosong jika Anda tidak ingin mengubah kata sandi.</p>
                
                <div class="space-y-6">
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-bold text-[var(--color-secondary)] font-mono mb-2 uppercase tracking-wider">Kata Sandi Baru</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password" id="password" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] shadow-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[var(--color-accent)] focus:border-[var(--color-accent)] sm:text-sm transition bg-[var(--color-background)] focus:bg-[var(--color-surface)]">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-[var(--color-text-secondary)] hover:text-[var(--color-text-primary)]">
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
                        @error('password') <p class="mt-2 text-sm text-red-600 font-mono">{{ $message }}</p> @enderror
                    </div>

                    <div x-data="{ show: false }">
                        <label for="password_confirmation" class="block text-sm font-bold text-[var(--color-secondary)] font-mono mb-2 uppercase tracking-wider">Konfirmasi Kata Sandi Baru</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_confirmation" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] shadow-sm placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-[var(--color-accent)] focus:border-[var(--color-accent)] sm:text-sm transition bg-[var(--color-background)] focus:bg-[var(--color-surface)]">
                            <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5 text-[var(--color-text-secondary)] hover:text-[var(--color-text-primary)]">
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
            </div>

            <div class="pt-6 border-t border-[var(--color-border)] flex justify-end">
                <button type="submit" class="flex justify-center py-3 px-6 border border-transparent rounded-[4px] shadow-sm text-sm font-bold font-mono text-[var(--color-primary)] bg-[var(--color-accent)] hover:bg-[#2c3e1e] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-accent)] transition">
                    SIMPAN PERUBAHAN
                </button>
            </div>
        </form>
    </x-card>

</div>
@endsection

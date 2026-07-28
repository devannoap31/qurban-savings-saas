@extends('layouts.auth')

@section('title', 'Akun Dinonaktifkan - Sylvan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <x-card class="max-w-md w-full space-y-8 animate-hero text-center border border-red-100">
        <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
        </div>
        
        <div>
            <h2 class="text-2xl font-display font-bold text-red-600 tracking-tight">
                Akun Dinonaktifkan
            </h2>
            <p class="mt-4 text-sm font-body text-[var(--color-text-secondary)] leading-relaxed">
                Maaf, akses akun Anda saat ini telah dinonaktifkan (suspended) oleh Superadmin. Anda tidak dapat masuk ke Dasbor Mitra.
            </p>
            <p class="mt-2 text-sm font-body text-[var(--color-text-secondary)]">
                Jika Anda merasa ini adalah kesalahan, silakan hubungi tim dukungan Sylvan Kurban.
            </p>
        </div>

        <div class="mt-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-body text-[var(--color-text-secondary)] hover:text-red-600 underline">
                    Keluar dari Sistem
                </button>
            </form>
        </div>
    </x-card>
</div>
@endsection

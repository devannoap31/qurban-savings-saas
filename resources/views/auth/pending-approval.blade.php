@extends('layouts.auth')

@section('title', 'Menunggu Persetujuan - Sylvan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <x-card class="max-w-md w-full space-y-8 animate-hero text-center">
        <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        
        <div>
            <h2 class="text-2xl font-display font-bold text-[var(--color-secondary)] tracking-tight">
                Akun Sedang Ditinjau
            </h2>
            <p class="mt-4 text-sm font-body text-[var(--color-text-secondary)] leading-relaxed">
                Email Anda telah berhasil diverifikasi, namun pendaftaran Anda sedang menunggu persetujuan dari Superadmin.
            </p>
            <p class="mt-2 text-sm font-body text-[var(--color-text-secondary)]">
                Kami akan memberitahu Anda segera setelah akun Anda diaktifkan. Harap bersabar!
            </p>
            <div class="mt-6 bg-gray-50 border border-gray-200 rounded-md p-4 text-left">
                <h3 class="text-xs font-bold text-gray-700 font-mono mb-1">BUTUH BANTUAN?</h3>
                <p class="text-xs font-body text-gray-600">
                    Jika akun Anda belum juga diaktifkan setelah 1x24 jam, silakan hubungi tim Superadmin kami melalui email di <strong>cs@sylvankurban.com</strong>.
                </p>
            </div>
        </div>

        <div class="mt-8">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-body text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] underline">
                    Keluar dari Sistem
                </button>
            </form>
        </div>
    </x-card>
</div>
@endsection

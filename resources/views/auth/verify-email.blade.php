@extends('layouts.auth')

@section('title', 'Verifikasi Email - Sylvan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <x-card class="max-w-md w-full space-y-8 animate-hero text-center">
        <div class="flex justify-center mb-4">
            <div class="w-16 h-16 bg-[#e3e8e0] text-[var(--color-secondary)] rounded-full flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
        
        <div>
            <h2 class="text-2xl font-display font-bold text-[var(--color-secondary)] tracking-tight">
                Verifikasi Email Anda
            </h2>
            <p class="mt-4 text-sm font-body text-[var(--color-text-secondary)] leading-relaxed">
                Terima kasih telah mendaftar! Sebelum memulai, silakan periksa kotak masuk email Anda dan klik tautan verifikasi yang telah kami kirimkan.
            </p>
            <p class="mt-2 text-sm font-body text-[var(--color-text-secondary)]">
                Jika Anda tidak menerima email tersebut, klik tombol di bawah ini untuk mengirim ulang.
            </p>
        </div>

        @if (session('message'))
            <div class="bg-green-50 text-green-700 p-4 rounded-[4px] text-sm font-mono border border-green-200">
                {{ session('message') }}
            </div>
        @endif

        <div class="mt-8 space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <x-button type="submit" variant="secondary" class="w-full justify-center py-3">
                    Kirim Ulang Email Verifikasi
                </x-button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-body text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] underline">
                    Keluar / Gunakan akun lain
                </button>
            </form>
        </div>
    </x-card>
</div>
@endsection

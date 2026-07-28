@extends('layouts.auth')

@section('title', 'Pendaftaran Berhasil - Sylvan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <x-card class="max-w-md w-full space-y-8 animate-hero text-center border border-green-100">
        <div class="flex justify-center mb-4">
            <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                </svg>
            </div>
        </div>
        
        <div>
            <h2 class="text-3xl font-display font-bold text-[var(--color-secondary)] tracking-tight">
                Langkah Terakhir!
            </h2>
            <p class="mt-4 text-base font-body text-[var(--color-text-secondary)] leading-relaxed">
                Pendaftaran akun {{ auth()->user()->role === 'admin' ? 'Mitra' : 'Jemaah' }} Anda telah kami terima. Kami telah mengirimkan email verifikasi ke alamat email Anda.
            </p>
            
            <div class="mt-6 bg-yellow-50 border border-yellow-200 rounded-md p-4 text-left">
                <h3 class="text-sm font-bold text-yellow-800 font-mono mb-2">📌 PERHATIAN PENTING:</h3>
                <ul class="text-sm font-body text-yellow-700 list-disc pl-5 space-y-1">
                    <li>Segera buka aplikasi <strong>Gmail / Yahoo</strong> Anda.</li>
                    <li>Cari email dari <strong>Sylvan Kurban</strong>.</li>
                    <li>Jika email tidak ada di Kotak Masuk (Inbox) utama, <strong>harap periksa folder Spam / Junk</strong> atau tab <strong>All Mail</strong>.</li>
                    <li>Klik tombol verifikasi di dalam email tersebut untuk mengaktifkan akun Anda.</li>
                </ul>
            </div>
        </div>

        <div class="mt-8" x-data="{ countdown: 60, canClick: false }" x-init="
            let interval = setInterval(() => {
                if (countdown > 0) {
                    countdown--;
                } else {
                    canClick = true;
                    clearInterval(interval);
                }
            }, 1000);
        ">
            <!-- Alert Info -->
            <p class="text-xs text-gray-500 font-body mb-4" x-show="!canClick">
                Tombol di bawah ini akan aktif dalam <span class="font-bold text-gray-700 font-mono" x-text="countdown + ' detik'"></span>.
            </p>

            <form method="POST" action="{{ route('mitra.register.cancel') }}">
                @csrf
                <button type="submit" 
                        :disabled="!canClick" 
                        :class="canClick ? 'bg-[var(--color-secondary)] hover:bg-[var(--color-accent)] cursor-pointer' : 'bg-gray-300 cursor-not-allowed'"
                        class="inline-flex w-full justify-center items-center px-4 py-3 border border-transparent text-sm font-bold font-mono rounded-[4px] shadow-sm text-[var(--color-primary)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-accent)] transition-all duration-300">
                    Keluar dan Ganti Email
                </button>
            </form>
            
            <div class="mt-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" 
                            :disabled="!canClick"
                            :class="canClick ? 'text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] underline cursor-pointer' : 'text-gray-400 cursor-not-allowed'"
                            class="text-xs font-body transition-colors">
                        Belum menerima email? Kirim ulang <span x-show="!canClick" x-text="'(' + countdown + 's)'"></span>
                    </button>
                </form>
            </div>
        </div>
    </x-card>
</div>
@endsection

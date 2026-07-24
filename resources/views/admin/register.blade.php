@extends('layouts.admin')

@section('title', 'Daftar Mitra - Tabungan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <x-card class="max-w-md w-full space-y-8 animate-hero">
        <div class="text-center">
            <h2 class="mt-2 text-3xl md:text-4xl font-display font-medium text-[var(--color-secondary)] tracking-tight leading-[1.04]">
                Daftar Sebagai Mitra
            </h2>
            <p class="mt-3 text-base font-body text-[var(--color-text-secondary)]">
                Lengkapi formulir di bawah ini untuk mengajukan pendaftaran masjid Anda
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="#" method="POST" onsubmit="event.preventDefault(); alert('Ini adalah simulasi. Di sistem nyata, data akan direkam dan masuk ke Super Admin untuk approval.');">
            @csrf
            
            <div class="space-y-5">
                <div>
                    <label for="nama_pengurus" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Nama Lengkap Pengurus</label>
                    <input id="nama_pengurus" name="nama_pengurus" type="text" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                </div>
                
                <div>
                    <label for="nama_masjid" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Nama Masjid</label>
                    <input id="nama_masjid" name="nama_masjid" type="text" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                </div>
                
                <div>
                    <label for="alamat" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Alamat Lengkap</label>
                    <textarea id="alamat" name="alamat" required rows="3" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors"></textarea>
                </div>
                
                <div>
                    <label for="email" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Email (Untuk Login Nanti)</label>
                    <input id="email" name="email" type="email" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                </div>
                
                <div>
                    <label for="password" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Kata Sandi</label>
                    <input id="password" name="password" type="password" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                </div>
            </div>

            <div>
                <x-button type="submit" variant="secondary" class="w-full justify-center py-3.5">
                    Ajukan Pendaftaran
                </x-button>
            </div>
            
            <div class="text-center mt-6">
                <a href="{{ route('mitra.login') }}" class="text-sm font-body text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] hover:underline transition">Sudah punya akun? Masuk di sini</a>
            </div>
        </form>
    </x-card>
</div>
@endsection

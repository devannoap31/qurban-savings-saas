@extends('layouts.auth')

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
        
        <form class="mt-8 space-y-6" action="{{ route('mitra.register.post') }}" method="POST" x-data="{ showPassword: false }">
            @csrf
            
            <div class="space-y-5">
                <div>
                    <label for="nama_pengurus" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Nama Lengkap Pengurus</label>
                    <input id="nama_pengurus" name="nama_pengurus" type="text" value="{{ old('nama_pengurus') }}" required class="appearance-none block w-full px-4 py-3 border @error('nama_pengurus') border-red-500 @else border-[var(--color-border)] @enderror rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                    @error('nama_pengurus') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="nama_masjid" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Nama Masjid</label>
                    <input id="nama_masjid" name="nama_masjid" type="text" value="{{ old('nama_masjid') }}" required class="appearance-none block w-full px-4 py-3 border @error('nama_masjid') border-red-500 @else border-[var(--color-border)] @enderror rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                    @error('nama_masjid') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="alamat" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Alamat Lengkap</label>
                    <textarea id="alamat" name="alamat" required rows="3" class="appearance-none block w-full px-4 py-3 border @error('alamat') border-red-500 @else border-[var(--color-border)] @enderror rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">{{ old('alamat') }}</textarea>
                    @error('alamat') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Email Asli (Untuk Lupa Sandi & Login)</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required class="appearance-none block w-full px-4 py-3 border @error('email') border-red-500 @else border-[var(--color-border)] @enderror rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="password" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Kata Sandi</label>
                        <input id="password" name="password" :type="showPassword ? 'text' : 'password'" required class="appearance-none block w-full px-4 py-3 border @error('password') border-red-500 @else border-[var(--color-border)] @enderror rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                        @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-xs font-mono font-semibold text-[var(--color-text-secondary)] mb-1 uppercase">Konfirmasi Kata Sandi</label>
                        <input id="password_confirmation" name="password_confirmation" :type="showPassword ? 'text' : 'password'" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-primary)] text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-accent)] focus:border-transparent font-body sm:text-base transition-colors">
                    </div>
                </div>

                <div class="flex items-center mt-2">
                    <input id="show_password" type="checkbox" x-model="showPassword" class="h-4 w-4 text-[var(--color-accent)] focus:ring-[var(--color-accent)] border-[var(--color-border)] rounded">
                    <label for="show_password" class="ml-2 block text-sm font-body text-[var(--color-text-secondary)]">Tampilkan kata sandi</label>
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

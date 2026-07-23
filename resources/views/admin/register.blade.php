@extends('layouts.app')

@section('title', 'Daftar Mitra - Tabungan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-[var(--color-tertiary)] p-10 rounded-[8px] border border-[var(--color-border)] shadow-sm">
        <div>
            <h2 class="mt-2 text-center text-3xl font-bold tracking-tight text-[var(--color-on-surface)]">
                Daftar Sebagai Mitra
            </h2>
            <p class="mt-2 text-center text-sm text-[var(--color-muted)]">
                Lengkapi formulir di bawah ini untuk mengajukan pendaftaran masjid Anda
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="#" method="POST" onsubmit="event.preventDefault(); alert('Ini adalah simulasi. Di sistem nyata, data akan direkam dan masuk ke Super Admin untuk approval.');">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label for="nama_pengurus" class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Nama Lengkap Pengurus</label>
                    <input id="nama_pengurus" name="nama_pengurus" type="text" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] sm:text-sm">
                </div>
                
                <div>
                    <label for="nama_masjid" class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Nama Masjid</label>
                    <input id="nama_masjid" name="nama_masjid" type="text" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] sm:text-sm">
                </div>
                
                <div>
                    <label for="alamat" class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Alamat Lengkap</label>
                    <textarea id="alamat" name="alamat" required rows="3" class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] sm:text-sm"></textarea>
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Email (Untuk Login Nanti)</label>
                    <input id="email" name="email" type="email" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] sm:text-sm">
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Password</label>
                    <input id="password" name="password" type="password" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] sm:text-sm">
                </div>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-[4px] shadow-sm text-sm font-medium text-white bg-[var(--color-primary)] hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-primary)] transition">
                    Ajukan Pendaftaran
                </button>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-sm font-medium text-[var(--color-primary)] hover:underline">Sudah punya akun? Masuk di sini</a>
            </div>
        </form>
    </div>
</div>
@endsection

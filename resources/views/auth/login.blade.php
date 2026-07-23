@extends('layouts.app')

@section('title', 'Login - Tabungan Kurban')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-[var(--color-tertiary)] p-10 rounded-[8px] border border-[var(--color-border)] shadow-sm">
        <div>
            <h2 class="mt-2 text-center text-3xl font-bold tracking-tight text-[var(--color-on-surface)]">
                Masuk ke Akun Anda
            </h2>
            <p class="mt-2 text-center text-sm text-[var(--color-muted)]">
                Silakan login menggunakan email yang terdaftar
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ route('login.post') }}" method="POST">
            @csrf
            
            @if ($errors->any())
                <div class="bg-red-50 text-[var(--color-error)] p-4 rounded-[4px] text-sm font-medium">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Email address</label>
                    <input id="email" name="email" type="email" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] sm:text-sm" placeholder="Email (contoh: superadmin@example.com)">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-[var(--color-on-surface)] mb-1">Password</label>
                    <input id="password" name="password" type="password" required class="appearance-none block w-full px-4 py-3 border border-[var(--color-border)] rounded-[4px] bg-[var(--color-neutral)] text-[var(--color-on-surface)] focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] focus:border-[var(--color-primary)] sm:text-sm" placeholder="Password (default: password)">
                </div>
            </div>

            <div>
                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-[4px] shadow-sm text-sm font-medium text-white bg-[var(--color-primary)] hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-primary)] transition">
                    Masuk Sekarang
                </button>
            </div>
            
            <div class="mt-6">
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-[var(--color-border)]"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-[var(--color-tertiary)] text-[var(--color-muted)]">
                            Atau gunakan kredensial demo
                        </span>
                    </div>
                </div>
                
                <div class="mt-6 grid grid-cols-1 gap-3">
                    <div class="text-xs text-center space-y-2 text-[var(--color-muted)]">
                        <p><strong>Admin:</strong> admin@zayed.com / password</p>
                        <p><strong>Jemaah:</strong> jemaah@example.com / password</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

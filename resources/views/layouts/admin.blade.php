<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tabungan Kurban Multi-Tenant')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <!-- Google Fonts: DM Sans, Playfair Display, JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[var(--color-background)] text-[var(--color-text-primary)] font-body antialiased min-h-screen flex flex-col selection:bg-[var(--color-accent)] selection:text-[var(--color-primary)]">

    <!-- Navigation -->
    <nav class="bg-[var(--color-surface)] border-b border-[var(--color-border)] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-display font-bold text-[var(--color-secondary)] tracking-tight hover:text-[var(--color-accent)] transition">
                        Sylvan Kurban
                    </a>
                </div>
                <div class="flex items-center gap-6 font-display">
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] font-medium text-sm transition">Dasbor Pengurus</a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="border border-[var(--color-border)] text-[var(--color-text-primary)] px-5 py-2.5 rounded-full text-sm font-medium hover:bg-[var(--color-border)] transition">Keluar</button>
                        </form>
                    @else
                        <a href="{{ route('mitra.login') }}" class="text-[var(--color-text-secondary)] hover:text-[var(--color-secondary)] font-medium text-sm transition">Masuk Mitra</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[var(--color-surface)] border-t border-[var(--color-border)] py-12 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="font-display font-bold text-lg text-[var(--color-secondary)] mb-4">Sylvan Kurban</h3>
                    <p class="font-body text-[var(--color-text-secondary)] text-sm leading-relaxed">Menumbuhkan kebaikan bersama melalui transparansi dan ketenangan dalam beribadah kurban.</p>
                </div>
                <div>
                    <h3 class="font-display font-bold text-lg text-[var(--color-secondary)] mb-4">Tautan</h3>
                    <ul class="space-y-2 text-sm text-[var(--color-text-secondary)] font-body">
                        <li><a href="#" class="hover:text-[var(--color-accent)] transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-[var(--color-accent)] transition">Panduan Tabungan</a></li>
                        <li><a href="{{ route('mitra') }}" class="hover:text-[var(--color-accent)] transition">Untuk Pengurus Masjid</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-display font-bold text-lg text-[var(--color-secondary)] mb-4">Dukungan</h3>
                    <ul class="space-y-2 text-sm text-[var(--color-text-secondary)] font-body">
                        <li><a href="#" class="hover:text-[var(--color-accent)] transition">Pusat Bantuan</a></li>
                        <li><a href="#" class="hover:text-[var(--color-accent)] transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-[var(--color-accent)] transition">Syarat & Ketentuan</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-[var(--color-border)] mt-12 pt-8 text-center text-sm font-mono text-[var(--color-text-secondary)]">
                &copy; {{ date('Y') }} Sylvan Kurban. All rights reserved.
            </div>
        </div>
    </footer>
    
    @stack('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tabungan Kurban Multi-Tenant')</title>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[var(--color-surface)] text-[var(--color-on-surface)] font-sans antialiased min-h-screen flex flex-col selection:bg-[var(--color-primary)] selection:text-white">

    <!-- Navigation -->
    <nav class="bg-white border-b border-[var(--color-border)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="/" class="text-xl font-bold text-[var(--color-primary)]">
                            TabunganKurban
                        </a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'superadmin')
                            <a href="{{ route('admin.dashboard') }}" class="text-[var(--color-on-surface)] hover:text-[var(--color-primary)] font-medium px-3 py-2 text-sm">Dashboard Admin</a>
                        @else
                            <a href="{{ route('jemaah.dashboard') }}" class="text-[var(--color-on-surface)] hover:text-[var(--color-primary)] font-medium px-3 py-2 text-sm">Dashboard Jemaah</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-[var(--color-neutral)] border border-[var(--color-border)] text-[var(--color-on-surface)] px-4 py-2 rounded-[4px] text-sm font-medium hover:bg-[var(--color-tertiary)] transition">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-[var(--color-on-surface)] hover:text-[var(--color-primary)] font-medium px-3 py-2 text-sm">Masuk</a>
                        <a href="{{ route('mitra') }}" class="bg-[var(--color-primary)] text-white px-4 py-2 rounded-[4px] text-sm font-medium hover:bg-blue-700 transition">Mitra Masjid</a>
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
    <footer class="bg-[var(--color-tertiary)] border-t border-[var(--color-border)] py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-sm text-[var(--color-muted)]">
            &copy; {{ date('Y') }} Tabungan Kurban Multi-Tenant. All rights reserved.
        </div>
    </footer>
    
</body>
</html>

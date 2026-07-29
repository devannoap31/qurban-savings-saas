@extends('layouts.dashboard-superadmin')

@section('title', 'Arsip Takmir - Superadmin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
    
    <div class="mb-8 animate-hero">
        <h1 class="text-3xl font-display font-medium text-[var(--color-secondary)]">Arsip Data Takmir</h1>
        <p class="text-[var(--color-text-secondary)] font-body mt-2">Daftar akun takmir yang telah ditolak atau dihapus. Anda dapat memulihkannya jika diperlukan.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 text-green-700 p-4 rounded-[4px] text-sm font-mono border border-green-200 animate-hero">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 animate-hero gap-4">
        <form class="flex flex-wrap items-center gap-3 w-full md:w-auto">
            <div class="relative w-full md:w-80">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau email..." class="pl-9 pr-4 py-2 border border-[var(--color-border)] rounded-[8px] text-sm focus:outline-none focus:ring-1 focus:ring-[var(--color-accent)] w-full font-body bg-[var(--color-surface)] shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[var(--color-text-secondary)] absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
            </div>
            <button type="submit" class="px-4 py-2 bg-[var(--color-background)] border border-[var(--color-border)] text-[var(--color-text-primary)] rounded-[8px] text-sm font-medium hover:bg-gray-200 transition">Cari</button>
        </form>
    </div>

    <x-card class="p-0 overflow-hidden animate-card">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-[var(--color-background)] border-b border-[var(--color-border)]">
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">NAMA TAKMIR</th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">EMAIL</th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">MASJID TERKAIT</th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">TANGGAL DIHAPUS</th>
                        <th class="py-4 px-6 text-xs font-mono font-semibold text-[var(--color-text-secondary)] tracking-wider">AKSI</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 font-body">
                    @forelse($archived_admins as $admin)
                    <tr class="hover:bg-[var(--color-background)]/50 transition">
                        <td class="py-5 px-6 font-display font-medium text-[var(--color-text-secondary)] line-through">{{ $admin->name }}</td>
                        <td class="py-5 px-6 text-sm text-[var(--color-text-secondary)]">{{ $admin->email }}</td>
                        <td class="py-5 px-6 text-sm text-[var(--color-text-secondary)]">{{ $admin->masjid->name ?? '-' }}</td>
                        <td class="py-5 px-6 text-sm text-[var(--color-text-secondary)]">{{ $admin->deleted_at->format('d M Y, H:i') }}</td>
                        <td class="py-5 px-6 text-sm">
                            <form action="{{ route('superadmin.restore', $admin->id) }}" method="POST" onsubmit="return confirm('Pulihkan akun ini? Akun akan kembali aktif.')">
                                @csrf @method('POST')
                                <button type="submit" class="font-mono text-blue-600 font-semibold hover:underline">PULIHKAN</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-10 text-center font-body text-[var(--color-text-secondary)]">Tidak ada data di dalam arsip.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-card>
    
    <div class="mt-6">
        {{ $archived_admins->links() }}
    </div>

</div>
@endsection

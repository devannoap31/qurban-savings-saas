@extends('layouts.public-jemaah')

@section('title', 'Pusat Bantuan - Sylvan Kurban')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24 animate-hero">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-display font-medium text-[var(--color-secondary)] mb-6 tracking-tight">
            Pusat <span class="italic font-body text-[var(--color-accent)]">Bantuan</span>
        </h1>
        <p class="text-lg font-body text-[var(--color-text-secondary)] max-w-2xl mx-auto">
            Pertanyaan yang sering diajukan dan cara menghubungi tim Sylvan Kurban.
        </p>
    </div>

    <div class="space-y-6">
        <x-card class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] p-8">
            <h3 class="font-display text-lg font-bold text-[var(--color-secondary)] mb-2">Apakah aplikasi ini gratis?</h3>
            <p class="font-body text-[var(--color-text-secondary)] text-sm leading-relaxed">
                Ya. Sylvan Kurban 100% gratis digunakan baik oleh Jemaah maupun Pengurus Masjid. Niat kami adalah mempermudah pengelolaan ibadah kurban di Indonesia.
            </p>
        </x-card>
        
        <x-card class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] p-8">
            <h3 class="font-display text-lg font-bold text-[var(--color-secondary)] mb-2">Bagaimana jika uang tabungan saya tidak mencapai target hingga Idul Adha?</h3>
            <p class="font-body text-[var(--color-text-secondary)] text-sm leading-relaxed">
                Tergantung kebijakan masing-masing masjid. Namun umumnya, dana yang belum memenuhi target kurban tahun ini akan dialihkan (Rollover) sebagai saldo awal tabungan kurban tahun depan.
            </p>
        </x-card>
        
        <x-card class="bg-[var(--color-surface)] border border-[var(--color-border)] rounded-[8px] p-8">
            <h3 class="font-display text-lg font-bold text-[var(--color-secondary)] mb-2">Apakah saya menyetor uang ke rekening Sylvan Kurban?</h3>
            <p class="font-body text-[var(--color-text-secondary)] text-sm leading-relaxed">
                TIDAK. Kami hanya penyedia platform pencatatan. Semua uang Anda ditransfer LANGSUNG ke rekening resmi milik Takmir Masjid yang bersangkutan. Hal ini demi menjaga transparansi dan menghindari penipuan.
            </p>
        </x-card>
    </div>

    <div class="mt-16 text-center border-t border-[var(--color-border)] pt-12">
        <h3 class="text-2xl font-display font-bold text-[var(--color-secondary)] mb-4">Masih butuh bantuan?</h3>
        <p class="font-body text-[var(--color-text-secondary)] mb-8">Hubungi tim *support* kami melalui email di bawah ini.</p>
        <a href="mailto:support@sylvankurban.com" class="inline-block border border-[var(--color-border)] bg-[var(--color-primary)] text-[var(--color-text-primary)] px-8 py-3 rounded-full text-sm font-display font-medium hover:bg-[var(--color-background)] transition">
            support@sylvankurban.com
        </a>
    </div>
</div>
@endsection

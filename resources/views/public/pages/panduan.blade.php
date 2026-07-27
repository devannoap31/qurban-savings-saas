@extends('layouts.public-jemaah')

@section('title', 'Panduan Tabungan - Sylvan Kurban')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24 animate-hero">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-display font-medium text-[var(--color-secondary)] mb-6 tracking-tight">
            Panduan <span class="italic font-body text-[var(--color-accent)]">Tabungan</span>
        </h1>
        <p class="text-lg font-body text-[var(--color-text-secondary)] max-w-2xl mx-auto">
            Langkah demi langkah memulai niat baik Anda hingga terwujud di hari raya Kurban.
        </p>
    </div>

    <div class="space-y-12">
        <div class="flex flex-col md:flex-row gap-8 items-start">
            <div class="w-16 h-16 shrink-0 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center text-2xl font-display font-bold">1</div>
            <div>
                <h3 class="text-2xl font-display font-bold text-[var(--color-secondary)] mb-3">Mencari Masjid Terdekat</h3>
                <p class="font-body text-[var(--color-text-secondary)] leading-relaxed">
                    Gunakan fitur pencarian di halaman utama untuk menemukan masjid di sekitar kota Anda yang membuka program tabungan kurban. Anda dapat meninjau jenis hewan, spesifikasi (bobot/tipe), dan target harga per slot yang ditawarkan oleh takmir masjid.
                </p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-8 items-start">
            <div class="w-16 h-16 shrink-0 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center text-2xl font-display font-bold">2</div>
            <div>
                <h3 class="text-2xl font-display font-bold text-[var(--color-secondary)] mb-3">Memesan Slot Kurban</h3>
                <p class="font-body text-[var(--color-text-secondary)] leading-relaxed">
                    Setelah menemukan masjid yang cocok, login ke dalam sistem dan lakukan pendaftaran slot. Anda akan diminta menyetujui target nominal tabungan. (Catatan: 1 ekor sapi biasanya terdiri dari 7 slot, sedangkan kambing 1 slot).
                </p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-8 items-start">
            <div class="w-16 h-16 shrink-0 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center text-2xl font-display font-bold">3</div>
            <div>
                <h3 class="text-2xl font-display font-bold text-[var(--color-secondary)] mb-3">Menyetor Tabungan secara Berkala</h3>
                <p class="font-body text-[var(--color-text-secondary)] leading-relaxed">
                    Anda dapat melakukan setoran cicilan kapan saja. Cukup transfer ke rekening masjid yang tertera, lalu unggah bukti transfer melalui <em>Dashboard Jemaah</em>. Takmir masjid akan memverifikasi setoran Anda dalam waktu 1x24 jam.
                </p>
            </div>
        </div>

        <div class="flex flex-col md:flex-row gap-8 items-start">
            <div class="w-16 h-16 shrink-0 bg-[#e3e8e0] text-[var(--color-accent)] rounded-full flex items-center justify-center text-2xl font-display font-bold">4</div>
            <div>
                <h3 class="text-2xl font-display font-bold text-[var(--color-secondary)] mb-3">Pelaksanaan Kurban</h3>
                <p class="font-body text-[var(--color-text-secondary)] leading-relaxed">
                    Setelah saldo Anda mencapai target lunas, Anda tinggal menunggu hari raya Idul Adha. Panitia masjid akan memberikan laporan pengadaan hewan kurban secara transparan melalui sistem.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

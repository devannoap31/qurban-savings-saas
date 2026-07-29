@extends('layouts.public-jemaah')

@section('title', 'Tentang Kami - Sylvan Kurban')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24 animate-hero">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-display font-medium text-[var(--color-secondary)] mb-6 tracking-tight">
            Tentang <span class="italic font-body text-[var(--color-accent)]">Sylvan Kurban</span>
        </h1>
        <p class="text-lg font-body text-[var(--color-text-secondary)] max-w-2xl mx-auto">
            Membangun ekosistem kebaikan yang mempertemukan niat tulus dengan transparansi ibadah kurban.
        </p>
    </div>

    <div class="prose prose-lg prose-green mx-auto font-body text-[var(--color-text-primary)] leading-relaxed">
        <p class="mb-6">
            Di Sylvan Kurban, kami percaya bahwa setiap niat baik berhak tumbuh perlahan, disirami dengan kepercayaan dan diwujudkan dengan penuh kebahagiaan. Sylvan Kurban hadir bukan sekadar sebagai aplikasi, melainkan sebagai wadah kolaboratif yang menghubungkan jemaah dengan pengurus masjid di seluruh Nusantara.
        </p>
        
        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mt-12 mb-4">Misi Kami</h2>
        <p class="mb-6">
            Kami bertujuan mendigitalkan pencatatan tabungan kurban yang seringkali masih menggunakan cara tradisional. Dengan sistem Multi-Tenant kami, setiap masjid memiliki otonomi penuh untuk mengelola data jemaah, memvalidasi setoran, dan merencanakan pengadaan hewan kurban tanpa perlu repot membangun sistem IT sendiri.
        </p>
        
        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mt-12 mb-4">Nilai Inti (Core Values)</h2>
        <ul class="list-disc pl-6 space-y-3 text-[var(--color-text-secondary)] mb-12">
            <li><strong>Transparansi:</strong> Jemaah dapat melihat progres tabungan dan rincian alokasi dana secara langsung.</li>
            <li><strong>Ketenangan:</strong> Sistem mencatat setiap transaksi dengan rapi, menghindarkan jemaah dan panitia dari kesalahan perhitungan.</li>
            <li><strong>Organik:</strong> Kami terus bertumbuh perlahan menyesuaikan dengan kebutuhan masjid-masjid di daerah, membangun lingkungan "botanikal" yang segar secara UI maupun fungsi.</li>
        </ul>
        
        <div class="bg-[var(--color-surface)] border border-[var(--color-border)] p-8 rounded-[8px] text-center mt-12">
            <h3 class="font-display text-xl text-[var(--color-secondary)] mb-4">Bergabung Bersama Kami</h3>
            <p class="text-[var(--color-text-secondary)] mb-6 text-base">Apakah Anda pengurus masjid? Mari daftarkan masjid Anda dan permudah jemaah menabung kurban.</p>
            <a href="{{ route('mitra.register') }}" class="inline-block bg-[var(--color-secondary)] text-[var(--color-primary)] px-8 py-3 rounded-full text-sm font-display font-medium hover:bg-[var(--color-accent)] transition shadow-sm">
                Daftarkan Masjid
            </a>
        </div>
    </div>
</div>
@endsection

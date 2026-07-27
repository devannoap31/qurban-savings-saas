@extends('layouts.public-jemaah')

@section('title', 'Kebijakan Privasi - Sylvan Kurban')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24 animate-hero">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-display font-medium text-[var(--color-secondary)] mb-6 tracking-tight">
            Kebijakan <span class="italic font-body text-[var(--color-accent)]">Privasi</span>
        </h1>
        <p class="text-lg font-body text-[var(--color-text-secondary)] max-w-2xl mx-auto">
            Komitmen kami untuk melindungi data pribadi dan transaksi Anda.
        </p>
    </div>

    <div class="prose prose-lg prose-green mx-auto font-body text-[var(--color-text-primary)] leading-relaxed">
        <p>Terakhir diperbarui: 26 Juli 2026</p>
        
        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mt-12 mb-4">1. Pengumpulan Informasi</h2>
        <p class="mb-6">
            Kami mengumpulkan informasi dari Anda ketika Anda mendaftar di situs kami, masuk ke akun Anda, berpartisipasi dalam tabungan kurban, dan/atau saat *logout*. Data yang dikumpulkan mencakup nama, alamat email, nomor telepon, dan data transaksi (seperti bukti transfer).
        </p>
        
        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mt-12 mb-4">2. Penggunaan Informasi</h2>
        <p class="mb-6">
            Informasi apa pun yang kami kumpulkan dari Anda dapat digunakan untuk:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-[var(--color-text-secondary)] mb-6">
            <li>Mempersonalisasi pengalaman Anda dan menanggapi kebutuhan Anda masing-masing.</li>
            <li>Memfasilitasi Pengurus Masjid untuk memverifikasi setoran tabungan Anda.</li>
            <li>Memperbaiki situs web kami secara keseluruhan.</li>
            <li>Menghubungi Anda melalui email terkait informasi layanan.</li>
        </ul>
        
        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mt-12 mb-4">3. Keamanan Data</h2>
        <p class="mb-6">
            Kami menerapkan berbagai langkah keamanan untuk menjaga keamanan informasi pribadi Anda. Kata sandi Anda dienkripsi menggunakan *hashing* algoritma modern standar industri. Kami tidak pernah melihat atau menyimpan *password* mentah Anda.
        </p>

        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mt-12 mb-4">4. Pengungkapan kepada Pihak Ketiga</h2>
        <p class="mb-6">
            Kami tidak menjual, memperdagangkan, atau memindahkan ke pihak luar informasi identitas pribadi Anda. Hal ini tidak termasuk pihak ketiga yang tepercaya yang membantu kami dalam mengoperasikan situs web kami atau menjalankan bisnis kami, selama pihak tersebut setuju untuk merahasiakan informasi tersebut. Khusus untuk Jemaah, data Anda dibagikan HANYA kepada Takmir Masjid tempat Anda memilih menabung kurban.
        </p>
    </div>
</div>
@endsection

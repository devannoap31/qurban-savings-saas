@extends('layouts.public-jemaah')

@section('title', 'Syarat & Ketentuan - Sylvan Kurban')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-24 animate-hero">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-display font-medium text-[var(--color-secondary)] mb-6 tracking-tight">
            Syarat & <span class="italic font-body text-[var(--color-accent)]">Ketentuan</span>
        </h1>
        <p class="text-lg font-body text-[var(--color-text-secondary)] max-w-2xl mx-auto">
            Peraturan penggunaan layanan Sylvan Kurban.
        </p>
    </div>

    <div class="prose prose-lg prose-green mx-auto font-body text-[var(--color-text-primary)] leading-relaxed">
        <p class="mb-6">
            Dengan mengakses dan menggunakan *platform* Sylvan Kurban, Anda menyatakan setuju untuk mematuhi syarat dan ketentuan berikut ini. Harap membacanya dengan saksama.
        </p>
        
        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mt-12 mb-4">1. Status Layanan Sylvan Kurban</h2>
        <p class="mb-6">
            Sylvan Kurban adalah **Penyedia Platform (Perangkat Lunak)** yang menjembatani pencatatan transaksi antara Jemaah dengan Pengurus Masjid. Kami **BUKAN** lembaga amil zakat, bank, perusahaan dompet digital, atau panitia pemotongan hewan kurban.
        </p>
        
        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mt-12 mb-4">2. Tanggung Jawab Keuangan</h2>
        <p class="mb-6">
            Semua transaksi dan aliran dana terjadi secara langsung antara Jemaah dan Rekening Pengurus Masjid (*Peer-to-Peer*). Oleh karena itu:
        </p>
        <ul class="list-disc pl-6 space-y-2 text-[var(--color-text-secondary)] mb-6">
            <li>Sylvan Kurban **TIDAK PERNAH** menerima, menahan, atau memotong sepeser pun dari dana tabungan kurban Jemaah.</li>
            <li>Sylvan Kurban tidak bertanggung jawab secara hukum atas perselisihan, penyalahgunaan, atau penggelapan dana yang dilakukan oleh oknum Pengurus Masjid.</li>
            <li>Jemaah diwajibkan untuk memastikan validitas dan kredibilitas masjid tujuan sebelum mentransfer sejumlah uang.</li>
        </ul>
        
        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mt-12 mb-4">3. Kewajiban Pengurus Masjid (Mitra)</h2>
        <p class="mb-6">
            Masjid yang mendaftarkan diri sebagai Mitra Sylvan Kurban wajib memberikan data takmir yang valid. Pengurus Masjid dilarang memanipulasi laporan harga hewan, jumlah setoran jemaah, atau menggunakan dana kurban untuk kepentingan pribadi/lainnya yang tidak terkait dengan ibadah kurban Jemaah yang bersangkutan.
        </p>

        <h2 class="text-2xl font-display font-medium text-[var(--color-secondary)] mt-12 mb-4">4. Penghentian Layanan</h2>
        <p class="mb-6">
            Sylvan Kurban berhak (melalui Superadmin pusat) untuk memblokir akun Jemaah atau akun Mitra Masjid kapan saja tanpa pemberitahuan jika ditemukan adanya indikasi penipuan, pelanggaran hukum negara, atau ketidakpatuhan terhadap Syarat & Ketentuan ini.
        </p>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kurban Masjid</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 10px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2A4E35;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .header h1 {
            color: #0E2116;
            margin: 0 0 5px 0;
            font-size: 22px;
        }
        .header p {
            margin: 0;
            color: #666;
            font-size: 13px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            color: #2A4E35;
            font-size: 16px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #F3F6F3;
            color: #0E2116;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }
        td {
            padding: 8px;
            font-size: 11px;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: bold; }
        .text-red { color: #D92D20; }
        .text-green { color: #12B76A; }
        
        .summary-grid {
            width: 100%;
            margin-bottom: 20px;
        }
        .summary-box {
            background-color: #F3F6F3;
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
        }
        .summary-box.highlight {
            background-color: #E3E8E0;
            border-color: #2A4E35;
        }
        .summary-box .title {
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .summary-box .value {
            font-size: 18px;
            color: #0E2116;
            font-weight: bold;
        }
        
        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }
        .status-lunas { background-color: #d1fae5; color: #065f46; }
        .status-proses { background-color: #fef3c7; color: #92400e; }
        .status-belum { background-color: #f3f4f6; color: #374151; }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Rekapitulasi Pelaksanaan Kurban</h1>
        <p><strong>{{ $masjid->name }}</strong><br>
           {{ $masjid->address }}</p>
    </div>

    <div class="section">
        <h2 class="section-title">1. Ringkasan Finansial (Buku Kas)</h2>
        <table class="summary-grid" style="border: none;">
            <tr>
                <td style="border: none; width: 25%;">
                    <div class="summary-box">
                        <div class="title">Total Jemaah</div>
                        <div class="value">{{ $jemaahs->count() }} Orang</div>
                    </div>
                </td>
                <td style="border: none; width: 25%;">
                    <div class="summary-box">
                        <div class="title">Total Dana Masuk</div>
                        <div class="value text-green">Rp {{ number_format($totalSetoran, 0, ',', '.') }}</div>
                    </div>
                </td>
                <td style="border: none; width: 25%;">
                    <div class="summary-box">
                        <div class="title">Total Pengeluaran</div>
                        <div class="value text-red">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                    </div>
                </td>
                <td style="border: none; width: 25%;">
                    <div class="summary-box highlight">
                        <div class="title">Saldo Akhir Kurban</div>
                        <div class="value">Rp {{ number_format($totalSaldoTerkumpul, 0, ',', '.') }}</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">2. Data Hewan Kurban</h2>
        @if($hewanKurbans->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Jenis & Deskripsi</th>
                    <th width="15%" class="text-center">Kapasitas Slot</th>
                    <th width="15%" class="text-center">Slot Terisi</th>
                    <th width="15%" class="text-right">Harga per Slot</th>
                    <th width="15%" class="text-right">Total Harga Hewan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hewanKurbans as $index => $hewan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $hewan->jenis_hewan }}<br><span style="color: #666; font-size: 10px;">{{ $hewan->deskripsi }}</span></td>
                    <td class="text-center">{{ $hewan->kapasitas_slot }}</td>
                    <td class="text-center">{{ $hewan->slot_terisi }}</td>
                    <td class="text-right">Rp {{ number_format($hewan->target_per_slot, 0, ',', '.') }}</td>
                    <td class="text-right font-bold">Rp {{ number_format($hewan->target_per_slot * $hewan->kapasitas_slot, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Belum ada data hewan kurban.</p>
        @endif
    </div>

    <div class="section" style="page-break-before: always;">
        <h2 class="section-title">3. Daftar Peserta Kurban (Jemaah)</h2>
        @if($jemaahs->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama Jemaah</th>
                    <th width="30%">Pilihan Kurban</th>
                    <th width="20%" class="text-right">Total Setoran</th>
                    <th width="20%" class="text-center">Status Lunas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jemaahs as $index => $jemaah)
                @php
                    $target = $jemaah->hewanKurban ? $jemaah->hewanKurban->target_per_slot : 0;
                    $isLunas = $jemaah->total_saldo >= $target && $target > 0;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $jemaah->nama_jemaah }}</td>
                    <td>{{ $jemaah->hewanKurban->jenis_hewan ?? '-' }}</td>
                    <td class="text-right font-bold">Rp {{ number_format($jemaah->total_saldo, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if($isLunas)
                            <span class="status-badge status-lunas">LUNAS</span>
                        @elseif($jemaah->total_saldo > 0)
                            <span class="status-badge status-proses">MENCICIL</span>
                        @else
                            <span class="status-badge status-belum">BELUM MULAI</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Belum ada jemaah yang mendaftar.</p>
        @endif
    </div>

    <div class="section">
        <h2 class="section-title">4. Riwayat Arus Kas (Jurnal Keuangan)</h2>
        @if($riwayatTransaksi->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="15%">Tanggal</th>
                    <th width="15%">Kode Ref</th>
                    <th width="35%">Keterangan</th>
                    <th width="15%" class="text-right">Dana Masuk (Db)</th>
                    <th width="15%" class="text-right">Dana Keluar (Kr)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayatTransaksi as $index => $trx)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($trx['tanggal'])->format('d/m/Y') }}</td>
                    <td class="text-center" style="font-family: monospace;">{{ $trx['id'] }}</td>
                    <td>{{ $trx['keterangan'] }}</td>
                    @if($trx['tipe'] == 'Pemasukan')
                        <td class="text-right text-green">Rp {{ number_format($trx['nominal'], 0, ',', '.') }}</td>
                        <td class="text-right">-</td>
                    @else
                        <td class="text-right">-</td>
                        <td class="text-right text-red">Rp {{ number_format($trx['nominal'], 0, ',', '.') }}</td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Belum ada riwayat transaksi keuangan.</p>
        @endif
    </div>

    <div class="footer">
        <p>Dicetak oleh: Admin Masjid (Takmir) pada tanggal {{ now()->format('d/m/Y H:i:s') }}<br>
        Dokumen Laporan Sistem Sylvan Kurban.</p>
    </div>

</body>
</html>

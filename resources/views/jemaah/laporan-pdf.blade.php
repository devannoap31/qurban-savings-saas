<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Tabungan Kurban</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #2A4E35;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #0E2116;
            margin: 0 0 10px 0;
            font-size: 24px;
        }
        .header p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            color: #2A4E35;
            font-size: 18px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #F3F6F3;
            color: #0E2116;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        td {
            padding: 10px;
            font-size: 13px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .summary-box {
            background-color: #F3F6F3;
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
        }
        .summary-box p {
            margin: 5px 0;
        }
        .summary-box strong {
            color: #0E2116;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>Laporan Tabungan Kurban</h1>
        <p>{{ $jemaah->masjid->name }}<br>
           {{ $jemaah->masjid->address }}</p>
    </div>

    <div class="section">
        <h2 class="section-title">Informasi Tabungan</h2>
        <div class="summary-box">
            <p><strong>Nama Jemaah:</strong> {{ $jemaah->nama_jemaah }}</p>
            <p><strong>Pilihan Kurban:</strong> {{ $jemaah->hewanKurban->jenis_hewan }} ({{ $jemaah->hewanKurban->deskripsi }})</p>
            <p><strong>Target Tabungan:</strong> Rp {{ number_format($jemaah->hewanKurban->target_per_slot, 0, ',', '.') }}</p>
            <p><strong>Total Terkumpul:</strong> Rp {{ number_format($jemaah->total_saldo, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> {{ $jemaah->status }}</p>
        </div>
    </div>

    <div class="section">
        <h2 class="section-title">Riwayat Setoran Tabungan</h2>
        @if($setorans->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="25%">Tanggal</th>
                    <th width="40%">Keterangan</th>
                    <th width="25%" class="text-right">Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($setorans as $index => $setoran)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($setoran->tanggal_setor)->format('d/m/Y') }}</td>
                    <td>Setoran Kurban</td>
                    <td class="text-right">{{ number_format($setoran->nominal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="3" class="text-right">Total Setoran</th>
                    <th class="text-right">Rp {{ number_format($setorans->sum('nominal'), 0, ',', '.') }}</th>
                </tr>
            </tbody>
        </table>
        @else
        <p>Belum ada riwayat setoran.</p>
        @endif
    </div>

    <div class="section">
        <h2 class="section-title">Transparansi Pengeluaran Hewan Kurban</h2>
        @if($pengeluarans->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="10%">No</th>
                    <th width="25%">Tanggal</th>
                    <th width="40%">Keterangan</th>
                    <th width="25%" class="text-right">Nominal (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengeluarans as $index => $pengeluaran)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($pengeluaran->tanggal)->format('d/m/Y') }}</td>
                    <td>{{ $pengeluaran->nama_pengeluaran }}</td>
                    <td class="text-right">{{ number_format($pengeluaran->nominal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Belum ada pengeluaran terkait hewan kurban ini.</p>
        @endif
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d/m/Y H:i:s') }}<br>
        Dokumen ini digenerasi secara otomatis oleh sistem Sylvan Kurban dan merupakan bukti tabungan yang sah.</p>
    </div>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi Perpustakaan</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            color: #0d6efd;
            font-size: 20px;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 11px;
        }
        .summary-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .summary-table td {
            padding: 8px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }
        .summary-label {
            font-weight: bold;
            color: #495057;
            width: 25%;
        }
        .summary-value {
            font-size: 13px;
            font-weight: bold;
        }
        .text-danger {
            color: #dc3545;
        }
        .text-primary {
            color: #0d6efd;
        }
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .main-table th, .main-table td {
            border: 1px solid #dee2e6;
            padding: 7px 6px;
            text-align: left;
            vertical-align: top;
        }
        .main-table th {
            background-color: #0d6efd;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 9px;
        }
        .main-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .badge {
            display: inline-block;
            padding: 2px 5px;
            font-size: 8px;
            font-weight: bold;
            border-radius: 3px;
            text-transform: uppercase;
        }
        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }
        .badge-success {
            background-color: #198754;
            color: white;
        }
        .badge-danger {
            background-color: #dc3545;
            color: white;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 9px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>SISTEM PERPUSTAKAAN LARAVEL</h2>
        <p>Laporan Transaksi Peminjaman dan Pengembalian Buku</p>
        <p style="font-size: 9px; color: #999;">Dicetak pada: {{ now()->format('d F Y H:i') }}</p>
    </div>

    <table class="summary-table">
        <tr>
            <td class="summary-label">Total Transaksi:</td>
            <td class="summary-value text-primary">{{ count($transaksis) }}</td>
            <td class="summary-label">Total Denda:</td>
            <td class="summary-value text-danger">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
        </tr>
    </table>

    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 10%;">Kode</th>
                <th style="width: 22%;">Anggota</th>
                <th style="width: 24%;">Buku</th>
                <th style="width: 11%;" class="text-center">Tgl Pinjam</th>
                <th style="width: 11%;" class="text-center">Batas Kembali</th>
                <th style="width: 11%;" class="text-center">Tgl Kembali</th>
                <th style="width: 11%;" class="text-center">Status</th>
                <th style="width: 10%;" class="text-right">Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksis as $t)
            <tr>
                <td style="font-weight: bold;">{{ $t->kode_transaksi }}</td>
                <td>
                    <strong>{{ $t->anggota->nama }}</strong><br>
                    <span style="color: #666; font-size: 9px;">{{ $t->anggota->kode_anggota }}</span>
                </td>
                <td>
                    <strong>{{ $t->buku->judul }}</strong><br>
                    <span style="color: #666; font-size: 9px;">{{ $t->buku->kode_buku }}</span>
                </td>
                <td class="text-center">{{ $t->tanggal_pinjam->format('d/m/Y') }}</td>
                <td class="text-center">{{ $t->tanggal_kembali->format('d/m/Y') }}</td>
                <td class="text-center">
                    {{ $t->tanggal_dikembalikan ? $t->tanggal_dikembalikan->format('d/m/Y') : '-' }}
                </td>
                <td class="text-center">
                    @if($t->status == 'Dipinjam')
                        @if($t->terlambat > 0)
                            <span class="badge badge-danger">Late ({{ $t->terlambat }}h)</span>
                        @else
                            <span class="badge badge-warning">Active</span>
                        @endif
                    @else
                        <span class="badge badge-success">Returned</span>
                    @endif
                </td>
                <td class="text-right" style="font-weight: bold; color: #dc3545;">
                    {{ $t->denda_total > 0 ? 'Rp ' . number_format($t->denda_total, 0, ',', '.') : '-' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center" style="padding: 20px; color: #666;">
                    Tidak ada data transaksi.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini digenerate secara otomatis oleh Sistem Perpustakaan Laravel.</p>
    </div>
</body>
</html>

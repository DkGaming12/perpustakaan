@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0 text-primary"><i class="bi bi-receipt me-2"></i>Detail Transaksi #{{ $transaksi->kode_transaksi }}</h3>
            <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm px-4">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        @if($transaksi->status == 'Dipinjam' && $transaksi->terlambat > 0)
        <div class="alert alert-danger border-0 shadow-sm d-flex align-items-center mb-4 rounded-3" role="alert">
            <i class="bi bi-exclamation-triangle-fill fs-3 me-3 text-danger"></i>
            <div>
                <h6 class="alert-heading fw-bold mb-1">Peringatan: Peminjaman Terlambat!</h6>
                <span>Batas waktu pengembalian buku ini sudah terlewat selama <strong>{{ $transaksi->terlambat }} hari</strong>. Harap segera kembalikan buku dan kenakan denda keterlambatan sebesar <strong>Rp {{ number_format($transaksi->terlambat * 5000, 0, ',', '.') }}</strong>.</span>
            </div>
        </div>
        @endif

        <div class="row g-4">
            <!-- Informasi Peminjaman -->
            <div class="col-md-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3 border-bottom border-light">
                        <h5 class="mb-0 fw-bold text-secondary">Informasi Peminjaman</h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th style="width: 35%;" class="text-muted">Status Transaksi</th>
                                <td>{!! $transaksi->status_badge !!}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Tanggal Pinjam</th>
                                <td class="fw-semibold">{{ $transaksi->tanggal_pinjam->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Batas Pengembalian</th>
                                <td class="fw-semibold text-danger">{{ $transaksi->tanggal_kembali->format('d F Y') }}</td>
                            </tr>
                            @if($transaksi->status == 'Dikembalikan')
                            <tr>
                                <th class="text-muted">Tanggal Dikembalikan</th>
                                <td class="fw-semibold text-success">{{ $transaksi->tanggal_dikembalikan->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Denda Keterlambatan</th>
                                <td>
                                    @if($transaksi->denda > 0)
                                        <span class="badge bg-danger rounded-pill px-3 py-2">Rp {{ number_format($transaksi->denda, 0, ',', '.') }}</span>
                                    @else
                                        <span class="badge bg-success rounded-pill px-3 py-2">Tidak ada denda</span>
                                    @endif
                                </td>
                            </tr>
                            @else
                                @if($transaksi->terlambat > 0)
                                <tr>
                                    <th class="text-muted">Keterlambatan Saat Ini</th>
                                    <td><span class="badge bg-danger rounded-pill px-3 py-2">{{ $transaksi->terlambat }} Hari</span> (Denda: Rp {{ number_format($transaksi->terlambat * 5000, 0, ',', '.') }})</td>
                                </tr>
                                @endif
                            @endif
                            @if($transaksi->keterangan)
                            <tr>
                                <th class="text-muted">Keterangan</th>
                                <td>{{ $transaksi->keterangan }}</td>
                            </tr>
                            @endif
                        </table>

                        @if($transaksi->status == 'Dipinjam')
                        <div class="mt-4 pt-3 border-top text-end">
                            <form action="{{ route('transaksi.kembalikan', $transaksi->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin buku ini telah dikembalikan oleh anggota?');">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success fw-bold rounded-pill shadow-sm px-4 py-2">
                                    <i class="bi bi-check2-circle me-1"></i> Proses Pengembalian Buku
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informasi Buku & Anggota -->
            <div class="col-md-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <h6 class="text-muted fw-bold mb-3 text-uppercase"><i class="bi bi-book me-2"></i>Buku Dipinjam</h6>
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-light rounded p-2 me-3">
                                <i class="bi bi-journal-text fs-3 text-primary"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">{{ $transaksi->buku->judul }}</h6>
                                <p class="text-muted small mb-0">{{ $transaksi->buku->kode_buku }}</p>
                            </div>
                        </div>
                        <a href="{{ route('buku.show', $transaksi->buku_id) }}" class="btn btn-sm btn-outline-primary w-100 rounded-pill mt-2">Detail Buku</a>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-muted fw-bold mb-3 text-uppercase"><i class="bi bi-person me-2"></i>Peminjam</h6>
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-light rounded p-2 me-3">
                                <i class="bi bi-person-badge fs-3 text-success"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold mb-1">{{ $transaksi->anggota->nama }}</h6>
                                <p class="text-muted small mb-0">{{ $transaksi->anggota->kode_anggota }}</p>
                            </div>
                        </div>
                        <a href="{{ route('anggota.show', $transaksi->anggota_id) }}" class="btn btn-sm btn-outline-success w-100 rounded-pill mt-2">Profil Anggota</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

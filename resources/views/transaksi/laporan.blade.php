@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0 text-primary"><i class="bi bi-file-earmark-bar-graph me-2"></i>Laporan Transaksi</h3>
    @if(count($transaksis) > 0)
        <a href="{{ route('transaksi.export_pdf', request()->all()) }}" download="Laporan-Transaksi.pdf" class="btn btn-danger rounded-pill shadow-sm px-4 fw-bold">
            <i class="bi bi-file-pdf me-1"></i> Export PDF
        </a>
    @endif
</div>

<!-- Card Filter -->
<div class="card shadow-sm border-0 mb-4 rounded-3">
    <div class="card-body p-4">
        <h5 class="fw-bold text-secondary mb-3"><i class="bi bi-funnel me-1"></i> Filter Laporan</h5>
        <form action="{{ route('transaksi.laporan') }}" method="GET" class="row g-3">
            <div class="col-md-3">
                <label class="form-label text-muted small fw-semibold">Dari Tanggal</label>
                <input type="date" name="tanggal_mulai" class="form-control rounded-3" value="{{ request('tanggal_mulai') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small fw-semibold">Sampai Tanggal</label>
                <input type="date" name="tanggal_selesai" class="form-control rounded-3" value="{{ request('tanggal_selesai') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small fw-semibold">Status</label>
                <select name="status" class="form-select rounded-3">
                    <option value="Semua" {{ request('status') == 'Semua' ? 'selected' : '' }}>Semua Status</option>
                    <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                    <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label text-muted small fw-semibold">Anggota</label>
                <select name="anggota_id" class="form-select rounded-3">
                    <option value="">Semua Anggota</option>
                    @foreach($anggotas as $a)
                        <option value="{{ $a->id }}" {{ request('anggota_id') == $a->id ? 'selected' : '' }}>{{ $a->nama }} ({{ $a->kode_anggota }})</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 text-end mt-4">
                <a href="{{ route('transaksi.laporan') }}" class="btn btn-outline-secondary rounded-pill px-4 me-2">Reset</a>
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-search me-1"></i> Tampilkan Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Summary Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-3 bg-white p-3 h-100 border-start border-primary border-4">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3 text-primary">
                    <i class="bi bi-calculator fs-3"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted small fw-bold text-uppercase">Total Transaksi</h6>
                    <h2 class="mb-0 fw-bold text-primary">{{ count($transaksis) }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-3 bg-white p-3 h-100 border-start border-danger border-4">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3 text-danger">
                    <i class="bi bi-cash-stack fs-3"></i>
                </div>
                <div>
                    <h6 class="mb-0 text-muted small fw-bold text-uppercase">Total Denda</h6>
                    <h2 class="mb-0 fw-bold text-danger">Rp {{ number_format($totalDenda, 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Table -->
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-secondary">
                    <tr>
                        <th class="px-4 py-3">Kode</th>
                        <th class="py-3">Anggota</th>
                        <th class="py-3">Buku</th>
                        <th class="py-3 text-center">Pinjam</th>
                        <th class="py-3 text-center">Batas Kembali</th>
                        <th class="py-3 text-center">Tgl Kembali</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-end">Denda</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $t)
                    <tr>
                        <td class="px-4 py-3 fw-bold text-secondary">{{ $t->kode_transaksi }}</td>
                        <td class="py-3">
                            <div class="fw-semibold">{{ $t->anggota->nama }}</div>
                            <small class="text-muted">{{ $t->anggota->kode_anggota }}</small>
                        </td>
                        <td class="py-3">
                            <div class="fw-semibold text-truncate" style="max-width: 220px;" title="{{ $t->buku->judul }}">{{ $t->buku->judul }}</div>
                            <small class="text-muted">{{ $t->buku->kode_buku }}</small>
                        </td>
                        <td class="py-3 text-center">{{ $t->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td class="py-3 text-center">{{ $t->tanggal_kembali->format('d/m/Y') }}</td>
                        <td class="py-3 text-center">
                            {{ $t->tanggal_dikembalikan ? $t->tanggal_dikembalikan->format('d/m/Y') : '-' }}
                        </td>
                        <td class="py-3 text-center">
                            {!! $t->status_badge !!}
                            @if($t->status == 'Dipinjam' && $t->terlambat > 0)
                                <span class="badge bg-danger d-block mt-1">Terlambat {{ $t->terlambat }} Hari</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end fw-semibold text-danger">
                            {{ $t->denda_total > 0 ? 'Rp ' . number_format($t->denda_total, 0, ',', '.') : '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                            Tidak ada data transaksi yang cocok dengan filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

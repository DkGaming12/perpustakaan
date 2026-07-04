@extends('layouts.app')

@section('title', 'Detail Anggota ' . $agt->nama)

@section('content')
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('anggota.index') }}" class="text-decoration-none">Anggota</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $agt->nama }}</li>
    </ol>
</nav>

<div class="row g-4 mb-4">
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-success text-white py-3 border-0">
                <h5 class="mb-0 fw-bold d-flex align-items-center">
                    <i class="bi bi-person-badge me-2"></i> Profil Anggota
                </h5>
            </div>
            <div class="card-body p-4 text-center">
                <div class="d-inline-block p-4 bg-light rounded-circle shadow-sm border border-2 border-success mb-3">
                    <i class="bi bi-person-fill text-success" style="font-size: 4rem;"></i>
                </div>
                <h5 class="fw-bold mb-1">{{ $agt->nama }}</h5>
                <span class="text-muted d-block mb-3">{{ $agt->kode_anggota }}</span>
                {!! $agt->status_badge !!}
            </div>
            <ul class="list-group list-group-flush border-top">
                <li class="list-group-item px-4 py-3">
                    <small class="text-muted d-block fw-semibold mb-1">Email</small>
                    {{ $agt->email }}
                </li>
                <li class="list-group-item px-4 py-3">
                    <small class="text-muted d-block fw-semibold mb-1">Telepon</small>
                    {{ $agt->telepon }}
                </li>
                <li class="list-group-item px-4 py-3">
                    <small class="text-muted d-block fw-semibold mb-1">Alamat</small>
                    {{ $agt->alamat }}
                </li>
                <li class="list-group-item px-4 py-3">
                    <small class="text-muted d-block fw-semibold mb-1">Detail Pribadi</small>
                    {{ $agt->jenis_kelamin }} &bull; {{ $agt->umur }} tahun ({{ $agt->kategori_usia }})
                    <br>{{ $agt->pekerjaan ?? '-' }}
                </li>
                <li class="list-group-item px-4 py-3">
                    <small class="text-muted d-block fw-semibold mb-1">Terdaftar</small>
                    {{ $agt->tanggal_daftar->format('d M Y') }} <small class="text-muted">({{ $agt->lama_anggota }} hari)</small>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-lg-8">
        <!-- Stats Row -->
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-primary bg-opacity-10 h-100">
                    <div class="card-body text-center p-3">
                        <i class="bi bi-arrow-left-right text-primary fs-3 d-block mb-2"></i>
                        <h3 class="fw-bold text-primary mb-0">{{ $totalPinjam }}</h3>
                        <span class="text-primary small fw-semibold">Total Transaksi</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-warning bg-opacity-10 h-100">
                    <div class="card-body text-center p-3">
                        <i class="bi bi-book text-warning fs-3 d-block mb-2"></i>
                        <h3 class="fw-bold text-warning mb-0">{{ $sedangPinjam }}</h3>
                        <span class="text-warning small fw-semibold text-dark">Buku Sedang Dipinjam</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-danger bg-opacity-10 h-100">
                    <div class="card-body text-center p-3">
                        <i class="bi bi-cash-coin text-danger fs-3 d-block mb-2"></i>
                        <h4 class="fw-bold text-danger mb-0 mt-1">Rp {{ number_format($totalDenda, 0, ',', '.') }}</h4>
                        <span class="text-danger small fw-semibold">Total Denda Dibayar</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaksi History -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent py-3 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold"><i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Peminjaman</h5>
                <form action="{{ route('anggota.show', $agt->id) }}" method="GET" class="d-flex gap-2">
                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                        <option value="Semua" {{ request('status') == 'Semua' ? 'selected' : '' }}>Semua</option>
                        <option value="Dipinjam" {{ request('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                        <option value="Dikembalikan" {{ request('status') == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    </select>
                </form>
            </div>
            <div class="card-body p-0">
                @if($transaksis->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Kode</th>
                                <th class="py-3">Buku</th>
                                <th class="py-3">Tgl Pinjam</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksis as $trx)
                            <tr>
                                <td class="px-4 py-3 text-primary fw-semibold">{{ $trx->kode_transaksi }}</td>
                                <td class="py-3">
                                    <div class="fw-semibold text-truncate" style="max-width:200px;">{{ $trx->buku->judul ?? '-' }}</div>
                                    <small class="text-muted">{{ $trx->buku->kode_buku ?? '-' }}</small>
                                </td>
                                <td class="py-3">{{ $trx->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td class="py-3">{!! $trx->status_badge !!}</td>
                                <td class="py-3 text-center">
                                    <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-inbox fs-1 d-block mb-3 opacity-50"></i>
                    <p>Tidak ada data transaksi peminjaman.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-4 text-center">
    <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Anggota
    </a>
</div>
@endsection

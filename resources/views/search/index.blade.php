@extends('layouts.app')

@section('title', $keyword ? 'Pencarian: ' . $keyword : 'Pencarian Global')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-search me-2 text-primary"></i>Pencarian Global</h2>
        @if($keyword)
            <p class="text-muted mb-0">Hasil pencarian untuk "<strong class="text-primary">{{ $keyword }}</strong>"</p>
        @endif
    </div>
</div>

<!-- Search Form -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body p-3">
        <form action="{{ route('search') }}" method="GET" class="d-flex gap-2">
            <div class="input-group">
                <span class="input-group-text bg-transparent"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="q" class="form-control" placeholder="Cari buku, anggota, atau transaksi..." value="{{ $keyword }}" autofocus>
            </div>
            <button type="submit" class="btn btn-primary px-4 rounded-pill">Cari</button>
        </form>
    </div>
</div>

@if($keyword)
<!-- Tabs -->
<ul class="nav nav-tabs mb-4" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $tab == 'buku' ? 'active' : '' }} fw-semibold" data-bs-toggle="tab" data-bs-target="#tab-buku" type="button">
            <i class="bi bi-book me-1"></i>Buku <span class="badge bg-primary rounded-pill ms-1">{{ $bukuResults->count() }}</span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $tab == 'anggota' ? 'active' : '' }} fw-semibold" data-bs-toggle="tab" data-bs-target="#tab-anggota" type="button">
            <i class="bi bi-people me-1"></i>Anggota <span class="badge bg-success rounded-pill ms-1">{{ $anggotaResults->count() }}</span>
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link {{ $tab == 'transaksi' ? 'active' : '' }} fw-semibold" data-bs-toggle="tab" data-bs-target="#tab-transaksi" type="button">
            <i class="bi bi-arrow-left-right me-1"></i>Transaksi <span class="badge bg-warning text-dark rounded-pill ms-1">{{ $transaksiResults->count() }}</span>
        </button>
    </li>
</ul>

<div class="tab-content">
    <!-- Tab Buku -->
    <div class="tab-pane fade {{ $tab == 'buku' ? 'show active' : '' }}" id="tab-buku">
        @if($bukuResults->count() > 0)
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Kode</th>
                                <th class="py-3">Judul</th>
                                <th class="py-3">Pengarang</th>
                                <th class="py-3">Kategori</th>
                                <th class="py-3">Stok</th>
                                <th class="py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bukuResults as $buku)
                            <tr>
                                <td class="px-4 py-3 fw-semibold text-primary">{{ $buku->kode_buku }}</td>
                                <td class="py-3">{!! highlightKeyword($buku->judul, $keyword) !!}</td>
                                <td class="py-3">{!! highlightKeyword($buku->pengarang, $keyword) !!}</td>
                                <td class="py-3"><span class="badge bg-light text-dark border">{{ $buku->kategori }}</span></td>
                                <td class="py-3">{!! $buku->status_stok_badge !!}</td>
                                <td class="py-3 text-center">
                                    <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-5 text-muted">
            <i class="bi bi-book fs-1 d-block mb-3 opacity-50"></i>
            <p>Tidak ada buku yang cocok dengan pencarian "{{ $keyword }}"</p>
        </div>
        @endif
    </div>

    <!-- Tab Anggota -->
    <div class="tab-pane fade {{ $tab == 'anggota' ? 'show active' : '' }}" id="tab-anggota">
        @if($anggotaResults->count() > 0)
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Kode</th>
                                <th class="py-3">Nama</th>
                                <th class="py-3">Email</th>
                                <th class="py-3">Telepon</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($anggotaResults as $agt)
                            <tr>
                                <td class="px-4 py-3 fw-semibold text-success">{{ $agt->kode_anggota }}</td>
                                <td class="py-3 fw-semibold">{!! highlightKeyword($agt->nama, $keyword) !!}</td>
                                <td class="py-3">{!! highlightKeyword($agt->email, $keyword) !!}</td>
                                <td class="py-3">{{ $agt->telepon }}</td>
                                <td class="py-3">{!! $agt->status_badge !!}</td>
                                <td class="py-3 text-center">
                                    <a href="{{ route('anggota.show', $agt->id) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-5 text-muted">
            <i class="bi bi-people fs-1 d-block mb-3 opacity-50"></i>
            <p>Tidak ada anggota yang cocok dengan pencarian "{{ $keyword }}"</p>
        </div>
        @endif
    </div>

    <!-- Tab Transaksi -->
    <div class="tab-pane fade {{ $tab == 'transaksi' ? 'show active' : '' }}" id="tab-transaksi">
        @if($transaksiResults->count() > 0)
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Kode</th>
                                <th class="py-3">Anggota</th>
                                <th class="py-3">Buku</th>
                                <th class="py-3">Tanggal Pinjam</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksiResults as $trx)
                            <tr>
                                <td class="px-4 py-3 fw-semibold text-warning">{!! highlightKeyword($trx->kode_transaksi, $keyword) !!}</td>
                                <td class="py-3">{!! highlightKeyword($trx->anggota->nama ?? '-', $keyword) !!}</td>
                                <td class="py-3">{!! highlightKeyword($trx->buku->judul ?? '-', $keyword) !!}</td>
                                <td class="py-3">{{ $trx->tanggal_pinjam->format('d/m/Y') }}</td>
                                <td class="py-3">{!! $trx->status_badge !!}</td>
                                <td class="py-3 text-center">
                                    <a href="{{ route('transaksi.show', $trx->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="text-center py-5 text-muted">
            <i class="bi bi-arrow-left-right fs-1 d-block mb-3 opacity-50"></i>
            <p>Tidak ada transaksi yang cocok dengan pencarian "{{ $keyword }}"</p>
        </div>
        @endif
    </div>
</div>
@else
<div class="text-center py-5 text-muted">
    <i class="bi bi-search fs-1 d-block mb-3 opacity-50"></i>
    <h5>Masukkan kata kunci untuk mencari</h5>
    <p>Cari di modul Buku, Anggota, dan Transaksi sekaligus</p>
</div>
@endif
@endsection

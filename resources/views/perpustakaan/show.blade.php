@extends('layouts.app')

@section('title', $buku->judul)

@section('content')
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('perpus.index') }}" class="text-decoration-none">Perpustakaan</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $buku->judul }}</li>
    </ol>
</nav>

<div class="card overflow-hidden">
    <div class="card-header bg-primary text-white py-3">
        <h3 class="mb-0 fw-bold d-flex align-items-center">
            <i class="bi bi-bookmark-star me-2"></i>
            {{ $buku->judul }}
        </h3>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <div class="col-lg-8">
                <h4 class="fw-bold mb-3 text-secondary">Informasi Buku</h4>
                <div class="table-responsive">
                    <table class="table table-borderless align-middle">
                        <tbody>
                            <tr>
                                <th scope="row" width="180" class="text-secondary">ID Buku</th>
                                <td class="fw-bold">: {{ $buku->id }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary">Kode Buku</th>
                                <td>: {{ $buku->kode_buku }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary">Judul</th>
                                <td>: {{ $buku->judul }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary">Kategori</th>
                                <td>: {{ $buku->kategori }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary">Pengarang</th>
                                <td>: {{ $buku->pengarang }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary">Penerbit</th>
                                <td>: {{ $buku->penerbit }}</td>
                            </tr>
                            @if ($buku->kota_penerbit || $buku->negara_penerbit)
                            <tr>
                                <th scope="row" class="text-secondary">Kota / Negara</th>
                                <td>: {{ $buku->kota_penerbit ?? '-' }}, {{ $buku->negara_penerbit ?? '-' }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th scope="row" class="text-secondary">Tahun Terbit</th>
                                <td>: {{ $buku->tahun_terbit }}
                                    <span class="badge bg-secondary-subtle text-secondary ms-2">{{ $buku->tahun_label }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary">ISBN</th>
                                <td>: {{ $buku->isbn ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary">Bahasa</th>
                                <td>: {{ $buku->bahasa }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary">Harga</th>
                                <td class="fw-semibold text-primary">: {{ $buku->harga_format }}</td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-secondary">Status Stok</th>
                                <td>: {!! $buku->status_stok_badge !!}
                                    <small class="text-muted ms-2">({{ $buku->stok }} unit)</small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr class="my-4">

                <h5 class="fw-bold text-secondary mb-2">Deskripsi Buku</h5>
                <p class="text-muted lh-lg fs-6">{{ $buku->deskripsi ?? 'Belum ada deskripsi.' }}</p>
            </div>
            <div class="col-lg-4">
                <div class="card bg-light border-0 shadow-sm p-4">
                    <div class="text-center">
                        <div class="p-3 bg-white d-inline-block rounded-circle shadow-sm mb-3">
                            <i class="bi bi-cart3 fs-1 text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-1 text-dark">Harga Peminjaman</h5>
                        <h2 class="text-primary fw-bold mb-3">{{ $buku->harga_format }}</h2>

                        @if ($buku->tersedia)
                            <button class="btn btn-success btn-lg w-100 rounded-pill shadow-sm d-flex align-items-center justify-content-center">
                                <i class="bi bi-plus-circle me-2"></i> Pinjam Buku
                            </button>
                        @else
                            <button class="btn btn-secondary btn-lg w-100 rounded-pill" disabled>
                                <i class="bi bi-slash-circle me-2"></i> Stok Habis
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mt-4">
    <a href="{{ route('perpus.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Buku
    </a>
</div>
@endsection

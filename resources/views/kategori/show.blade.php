@extends('layouts.app')

@section('title', 'Kategori ' . $kategori->nama_kategori)

@section('content')
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}" class="text-decoration-none">Kategori</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $kategori->nama_kategori }}</li>
    </ol>
</nav>

<div class="card p-4 border-0 shadow-sm mb-4">
    <div class="row align-items-center">
        <div class="col-md-2 text-center mb-3 mb-md-0">
            <div class="d-inline-block p-4 bg-primary bg-opacity-10 text-primary rounded-3">
                <i class="bi bi-tag-fill" style="font-size: 3rem;"></i>
            </div>
        </div>
        <div class="col-md-10">
            <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                <h2 class="fw-bold mb-0">{{ $kategori->nama_kategori }}</h2>
                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill fw-semibold">
                    {{ $buku_list->count() }} Buku Terdaftar
                </span>
            </div>
            <p class="text-muted fs-6 mb-0">{{ $kategori->deskripsi ?? 'Tidak ada deskripsi' }}</p>
        </div>
    </div>
</div>

<h3 class="fw-bold mb-3">Daftar Buku Dalam Kategori</h3>

<div class="card p-4 border-0 shadow-sm">
    @if ($buku_list->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light text-secondary">
                    <tr>
                        <th scope="col" width="60">No</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Pengarang</th>
                        <th scope="col" width="150">Status</th>
                        <th scope="col" width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($buku_list as $index => $buku)
                    <tr>
                        <td class="fw-bold text-secondary">{{ $index + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-primary bg-opacity-10 rounded text-primary me-3">
                                    <i class="bi bi-book fs-5"></i>
                                </div>
                                <span class="fw-semibold">{{ $buku->judul }}</span>
                            </div>
                        </td>
                        <td class="text-secondary">{{ $buku->pengarang }}</td>
                        <td>{!! $buku->status_stok_badge !!} <small class="text-muted ms-1">({{ $buku->stok }})</small></td>
                        <td class="text-center">
                            <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                Detail <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-exclamation-circle text-muted fs-1 mb-3 d-block"></i>
            <p class="text-secondary mb-0">Belum ada buku terdaftar dalam kategori ini.</p>
        </div>
    @endif
</div>

<div class="mt-4">
    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Kategori
    </a>
</div>
@endsection

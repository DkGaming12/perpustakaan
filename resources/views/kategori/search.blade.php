@extends('layouts.app')

@section('title', 'Hasil Pencarian Kategori "' . $keyword . '"')

@section('content')
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}" class="text-decoration-none">Kategori</a></li>
        <li class="breadcrumb-item active" aria-current="page">Pencarian: "{{ $keyword }}"</li>
    </ol>
</nav>

<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h1 class="fw-bold text-dark mb-1">Hasil Pencarian Kategori</h1>
        <p class="text-muted">Ditemukan {{ count($kategori_list) }} hasil untuk pencarian <strong class="text-primary">"{{ $keyword }}"</strong></p>
    </div>
    <div class="col-md-4 text-md-end">
        <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-x-circle me-1"></i> Bersihkan Pencarian
        </a>
    </div>
</div>

@if (count($kategori_list) > 0)
    <div class="row g-4">
        @foreach ($kategori_list as $kat)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 p-4 border border-light shadow-sm">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="p-3 bg-primary-subtle text-primary rounded-3">
                        <i class="bi bi-tag-fill fs-3"></i>
                    </div>
                    <span class="badge bg-secondary-subtle text-secondary px-3 py-2 rounded-pill fw-semibold">
                        {{ $kat['jumlah_buku'] }} Buku
                    </span>
                </div>
                <!-- Highlight keyword in Title -->
                <h4 class="fw-bold text-dark mb-2">
                    {!! str_ireplace($keyword, '<mark class="bg-warning text-dark px-1 rounded">' . htmlspecialchars($keyword) . '</mark>', htmlspecialchars($kat['nama'])) !!}
                </h4>
                <!-- Highlight keyword in Description -->
                <p class="text-muted small mb-4 flex-grow-1">
                    {!! str_ireplace($keyword, '<mark class="bg-warning text-dark px-1 rounded">' . htmlspecialchars($keyword) . '</mark>', htmlspecialchars($kat['deskripsi'])) !!}
                </p>
                <a href="{{ route('kategori.show', ['id' => $kat['id']]) }}" class="btn btn-outline-primary w-100 rounded-pill mt-auto">
                    Lihat Koleksi <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="card p-5 border border-light text-center">
        <div class="d-inline-block p-4 bg-light rounded-circle shadow-sm mb-4 mx-auto" style="width: 100px; height: 100px;">
            <i class="bi bi-emoji-frown fs-1 text-muted"></i>
        </div>
        <h3 class="fw-bold text-dark mb-2">Tidak Ada Hasil Ditemukan</h3>
        <p class="text-muted">Kategori dengan nama atau deskripsi mengandung "{{ $keyword }}" tidak terdaftar.</p>
        <div class="mt-3">
            <a href="{{ route('kategori.index') }}" class="btn btn-primary rounded-pill px-4">
                Kembali ke Kategori
            </a>
        </div>
    </div>
@endif
@endsection

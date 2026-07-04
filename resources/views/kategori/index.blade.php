@extends('layouts.app')

@section('title', 'Kategori Buku')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-tags me-2 text-primary"></i>Kategori Buku</h2>
        <p class="text-muted mb-0 small">Jelajahi buku berdasarkan kategori bidang studi</p>
    </div>
    <a href="{{ route('kategori.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="bi bi-plus-circle me-1"></i> Tambah Kategori
    </a>
</div>

<div class="row g-4">
    @forelse ($kategori_list as $kat)
    <div class="col-md-6 col-lg-4 animate-in">
        <div class="card h-100 p-4 border-0 shadow-sm">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-3">
                    <i class="bi bi-tag-fill fs-3"></i>
                </div>
                <span class="badge bg-secondary bg-opacity-10 text-secondary px-3 py-2 rounded-pill fw-semibold">
                    {{ $kat->jumlah_buku }} Buku
                </span>
            </div>
            <h4 class="fw-bold mb-2">{{ $kat->nama_kategori }}</h4>
            <p class="text-muted small mb-4 flex-grow-1">{{ $kat->deskripsi ?? 'Tidak ada deskripsi' }}</p>
            <div class="d-flex gap-2">
                <a href="{{ route('kategori.show', $kat->id) }}" class="btn btn-outline-primary flex-grow-1 rounded-pill">
                    Lihat Koleksi <i class="bi bi-arrow-right ms-1"></i>
                </a>
                <a href="{{ route('kategori.edit', $kat->id) }}" class="btn btn-outline-warning rounded-pill px-3" title="Edit">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('kategori.destroy', $kat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kategori ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger rounded-pill px-3" title="Hapus"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5 text-muted">
        <i class="bi bi-tags fs-1 d-block mb-3 opacity-50"></i>
        <p>Belum ada kategori. <a href="{{ route('kategori.create') }}">Tambah sekarang</a></p>
    </div>
    @endforelse
</div>
@endsection

@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}" class="text-decoration-none">Kategori</a></li>
        <li class="breadcrumb-item active">Edit {{ $kategori->nama_kategori }}</li>
    </ol>
</nav>

<div class="card border-0 shadow-sm" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header bg-warning text-dark py-3 border-0">
        <h5 class="mb-0 fw-bold"><i class="bi bi-pencil me-2"></i>Edit Kategori</h5>
    </div>
    <div class="card-body p-4">
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                @error('nama_kategori')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning px-4 rounded-pill"><i class="bi bi-check-lg me-1"></i> Perbarui</button>
                <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary rounded-pill px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

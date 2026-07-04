@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h1 class="fw-bold text-dark mb-1">{{ $nama_sistem }}</h1>
        <p class="text-muted">Selamat datang di sistem perpustakaan berbasis Laravel {{ $versi }}</p>
    </div>
    <div class="col-md-4 text-md-end">
        <span class="badge bg-primary px-3 py-2 rounded-pill fs-6 shadow-sm">
            <i class="bi bi-book-half me-1"></i> Total Buku: {{ $total_buku }}
        </span>
    </div>
</div>

<div class="card p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light text-secondary">
                <tr>
                    <th scope="col" width="60">No</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col" width="150">Harga</th>
                    <th scope="col" width="100">Stok</th>
                    <th scope="col" width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buku_list as $index => $buku)
                <tr>
                    <td class="fw-bold text-secondary">{{ $index + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="p-2 bg-light rounded text-primary me-3">
                                <i class="bi bi-book fs-4"></i>
                            </div>
                            <div>
                                <a href="{{ route('buku.show', $buku->id) }}" class="fw-semibold text-decoration-none text-dark d-block">
                                    {{ $buku->judul }}
                                </a>
                            </div>
                        </div>
                    </td>
                    <td class="text-secondary">{{ $buku->pengarang }}</td>
                    <td class="fw-semibold text-primary">Rp {{ number_format($buku->harga, 0, ',', '.') }}</td>
                    <td>
                        {!! $buku->status_stok_badge !!}
                    </td>
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
</div>
@endsection

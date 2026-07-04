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

<div class="card p-4 mb-4">
    <form action="{{ route('perpus.index') }}" method="GET" class="d-flex flex-wrap gap-2">
        <div class="input-group" style="flex: 1; min-width: 250px;">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" name="q" class="form-control border-start-0" placeholder="Cari judul atau pengarang..." value="{{ request('q') }}">
        </div>
        
        <select name="kategori" class="form-select" style="width: auto;">
            <option value="">-- Semua Kategori --</option>
            @foreach($kategoriList as $kat)
                <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary px-4 rounded-pill">Filter</button>
        @if(request('q') || request('kategori'))
            <a href="{{ route('perpus.index') }}" class="btn btn-outline-secondary rounded-pill">Reset</a>
        @endif
    </form>
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
                @forelse ($buku_list as $index => $buku)
                <tr>
                    <td class="fw-bold text-secondary">{{ ($buku_list->currentPage() - 1) * $buku_list->perPage() + $index + 1 }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="p-2 bg-light rounded text-primary me-3">
                                <i class="bi bi-book fs-4"></i>
                            </div>
                            <div>
                                <a href="{{ route('buku.show', $buku->id) }}" class="fw-semibold text-decoration-none text-dark d-block">
                                    {{ $buku->judul }}
                                </a>
                                <small class="text-muted">{{ $buku->kategori }}</small>
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
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">Belum ada data buku.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $buku_list->links() }}
    </div>
</div>
@endsection

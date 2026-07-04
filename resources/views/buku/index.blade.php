@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-book me-2 text-primary"></i>Manajemen Koleksi Buku</h2>
        <p class="text-muted mb-0 small">Kelola koleksi buku perpustakaan secara real-time</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('buku.export') }}" download="Data-Buku.csv" class="btn btn-outline-success rounded-pill px-3 shadow-sm">
            <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel
        </a>
        <a href="{{ route('buku.create') }}" class="btn btn-primary rounded-pill px-3 shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Buku
        </a>
    </div>
</div>

<!-- Search & Filter Card -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form action="{{ route('buku.index') }}" method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-semibold text-muted">Cari</label>
                <div class="input-group">
                    <span class="input-group-text bg-transparent"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control" placeholder="Judul, pengarang, kode..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold text-muted">Kategori</label>
                <select name="kategori" class="form-select">
                    <option value="">Semua</option>
                    @foreach($kategoriList as $kat)
                        <option value="{{ $kat }}" {{ request('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold text-muted">Ketersediaan</label>
                <select name="ketersediaan" class="form-select">
                    <option value="">Semua</option>
                    <option value="tersedia" {{ request('ketersediaan') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="habis" {{ request('ketersediaan') == 'habis' ? 'selected' : '' }}>Habis</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold text-muted">Harga Min</label>
                <input type="number" name="harga_min" class="form-control" placeholder="0" value="{{ request('harga_min') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-semibold text-muted">Harga Max</label>
                <input type="number" name="harga_max" class="form-control" placeholder="∞" value="{{ request('harga_max') }}">
            </div>
            <div class="col-md-1 d-flex gap-1">
                <button type="submit" class="btn btn-primary w-100" title="Filter"><i class="bi bi-funnel"></i></button>
                <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary" title="Reset"><i class="bi bi-x-lg"></i></a>
            </div>
        </form>
    </div>
</div>

<!-- Table -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3" width="50">No</th>
                        <th class="py-3" width="100">Kode</th>
                        <th class="py-3">Judul Buku</th>
                        <th class="py-3">Pengarang</th>
                        <th class="py-3" width="130">Harga</th>
                        <th class="py-3" width="100">Stok</th>
                        <th class="py-3 text-center" width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($buku_list as $index => $buku)
                    <tr>
                        <td class="px-4 py-3 fw-bold text-secondary">{{ ($buku_list->currentPage() - 1) * $buku_list->perPage() + $index + 1 }}</td>
                        <td class="py-3 fw-semibold text-primary">{{ $buku->kode_buku }}</td>
                        <td class="py-3">
                            <div class="d-flex align-items-center">
                                <div class="p-2 bg-primary bg-opacity-10 rounded text-primary me-3">
                                    <i class="bi bi-book fs-5"></i>
                                </div>
                                <div>
                                    <a href="{{ route('buku.show', $buku->id) }}" class="fw-semibold text-decoration-none d-block">
                                        {{ $buku->judul }}
                                    </a>
                                    <small class="text-muted">{{ $buku->kategori }} &bull; {{ $buku->tahun_label }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="py-3 text-secondary">{{ $buku->pengarang }}</td>
                        <td class="py-3 fw-semibold text-primary">{{ $buku->harga_format }}</td>
                        <td class="py-3">{!! $buku->status_stok_badge !!}</td>
                        <td class="py-3 text-center">
                            <div class="btn-group gap-1" role="group">
                                <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-outline-info btn-sm rounded px-2" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-outline-warning btn-sm rounded px-2" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm rounded px-2" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                            Tidak ada data buku yang cocok dengan filter.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Pagination -->
<div class="mt-4 d-flex justify-content-center">
    {{ $buku_list->links() }}
</div>
@endsection

@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
<div class="row mb-4 align-items-center gap-2">
    <div class="col-md-7">
        <h1 class="fw-bold text-dark mb-1"><i class="bi bi-people me-2 text-success"></i>Daftar Anggota Perpustakaan</h1>
        <p class="text-muted mb-0 small">Kelola data anggota aktif dan non-aktif perpustakaan</p>
    </div>
    <div class="col-md-4 text-md-end d-flex gap-2 justify-content-md-end">
        <a href="{{ route('anggota.export') }}" download="Data-Anggota.csv" class="btn btn-outline-success rounded-pill px-3 shadow-sm">
            <i class="bi bi-file-earmark-spreadsheet me-1"></i> Export Excel
        </a>
        <a href="{{ route('anggota.create') }}" class="btn btn-success rounded-pill px-3 shadow-sm">
            <i class="bi bi-person-plus me-1"></i> Tambah Anggota
        </a>
    </div>
</div>

<div class="card p-4 mb-4">
    <form action="{{ route('anggota.index') }}" method="GET" class="d-flex flex-wrap gap-2">
        <div class="input-group" style="flex: 1; min-width: 250px;">
            <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
            <input type="text" name="q" class="form-control border-start-0" placeholder="Cari nama atau kode anggota..." value="{{ request('q') }}">
        </div>
        
        <select name="status" class="form-select" style="width: auto;">
            <option value="">-- Semua Status --</option>
            <option value="Aktif" {{ request('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
            <option value="Nonaktif" {{ request('status') == 'Nonaktif' ? 'selected' : '' }}>Non-aktif</option>
        </select>
        
        <select name="jk" class="form-select" style="width: auto;">
            <option value="">-- Semua Jenis Kelamin --</option>
            <option value="Laki-laki" {{ request('jk') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ request('jk') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>

        <button type="submit" class="btn btn-primary px-4 rounded-pill">Filter</button>
        @if(request('q') || request('status') || request('jk'))
            <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary rounded-pill">Reset</a>
        @endif
    </form>
</div>

<div class="card p-4">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light text-secondary">
                <tr>
                    <th scope="col" width="60">No</th>
                    <th scope="col" width="120">Kode</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Email</th>
                    <th scope="col" width="120">Umur</th>
                    <th scope="col" width="150">Status</th>
                    <th scope="col" width="200" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggota_list as $index => $agt)
                <tr>
                    <td class="fw-bold text-secondary">{{ ($anggota_list->currentPage() - 1) * $anggota_list->perPage() + $index + 1 }}</td>
                    <td class="fw-semibold text-success">{{ $agt->kode_anggota }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="p-2 bg-light rounded text-success me-3">
                                <i class="bi bi-person fs-4"></i>
                            </div>
                            <div>
                                <a href="{{ route('anggota.show', $agt->id) }}" class="fw-semibold text-decoration-none text-dark d-block">
                                    {{ $agt->nama }}
                                </a>
                                <small class="text-muted">{{ $agt->jenis_kelamin }} &bull; {{ $agt->pekerjaan ?? '-' }}</small>
                            </div>
                        </div>
                    </td>
                    <td class="text-secondary">{{ $agt->email }}</td>
                    <td class="text-secondary">{{ $agt->umur }} tahun</td>
                    <td>{!! $agt->status_badge !!}</td>
                    <td class="text-center">
                        <div class="btn-group gap-2" role="group">
                            <a href="{{ route('anggota.show', $agt->id) }}" class="btn btn-outline-info btn-sm rounded px-2" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('anggota.edit', $agt->id) }}" class="btn btn-outline-warning btn-sm rounded px-2" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('anggota.destroy', $agt->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus anggota ini?')">
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
                    <td colspan="7" class="text-center text-muted py-4">Belum ada data anggota terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $anggota_list->links() }}
    </div>
</div>
@endsection

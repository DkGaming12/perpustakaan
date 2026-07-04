@extends('layouts.app')

@section('title', 'Transaksi Peminjaman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold mb-0 text-primary"><i class="bi bi-cart me-2"></i>Transaksi Peminjaman</h3>
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary rounded-pill shadow-sm px-4 fw-bold">
        <i class="bi bi-plus-circle me-1"></i> Pinjam Buku
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">Kode</th>
                        <th class="py-3">Anggota</th>
                        <th class="py-3">Buku</th>
                        <th class="py-3 text-center">Pinjam</th>
                        <th class="py-3 text-center">Batas Kembali</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $t)
                    <tr>
                        <td class="px-4 py-3 fw-bold text-secondary">{{ $t->kode_transaksi }}</td>
                        <td class="py-3">
                            <div class="fw-semibold">{{ $t->anggota->nama }}</div>
                            <small class="text-muted">{{ $t->anggota->kode_anggota }}</small>
                        </td>
                        <td class="py-3">
                            <div class="fw-semibold text-truncate" style="max-width: 200px;" title="{{ $t->buku->judul }}">
                                {{ $t->buku->judul }}
                            </div>
                            <small class="text-muted">{{ $t->buku->kode_buku }}</small>
                        </td>
                        <td class="py-3 text-center">{{ $t->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td class="py-3 text-center">
                            {{ $t->tanggal_kembali->format('d/m/Y') }}
                            @if($t->status == 'Dipinjam' && $t->terlambat > 0)
                                <br><small class="text-danger fw-bold">Terlambat {{ $t->terlambat }} hari</small>
                            @endif
                        </td>
                        <td class="py-3 text-center">
                            {!! $t->status_badge !!}
                            @if($t->status == 'Dipinjam' && $t->terlambat > 0)
                                <span class="badge bg-danger d-block mt-1">Terlambat {{ $t->terlambat }} Hari</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end">
                            <a href="{{ route('transaksi.show', $t->id) }}" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                            Belum ada data transaksi
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($transaksis->hasPages())
    <div class="card-footer bg-white border-top-0 py-3">
        {{ $transaksis->links() }}
    </div>
    @endif
</div>
@endsection

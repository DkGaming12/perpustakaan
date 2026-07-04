@extends('layouts.app')

@section('title', 'Pinjam Buku')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0 text-primary"><i class="bi bi-cart-plus me-2"></i>Form Peminjaman</h3>
            <a href="{{ route('transaksi.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm px-4">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="anggota_id" class="form-label fw-bold">Anggota <span class="text-danger">*</span></label>
                        <select name="anggota_id" id="anggota_id" class="form-select @error('anggota_id') is-invalid @enderror">
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($anggotas as $anggota)
                                <option value="{{ $anggota->id }}" {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
                                    {{ $anggota->kode_anggota }} - {{ $anggota->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('anggota_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">Hanya anggota aktif yang ditampilkan.</div>
                    </div>

                    <div class="mb-4">
                        <label for="buku_id" class="form-label fw-bold">Buku <span class="text-danger">*</span></label>
                        <select name="buku_id" id="buku_id" class="form-select @error('buku_id') is-invalid @enderror">
                            <option value="">-- Pilih Buku --</option>
                            @foreach($bukus as $buku)
                                <option value="{{ $buku->id }}" {{ old('buku_id') == $buku->id ? 'selected' : '' }}>
                                    {{ $buku->kode_buku }} - {{ $buku->judul }} (Sisa Stok: {{ $buku->stok }})
                                </option>
                            @endforeach
                        </select>
                        @error('buku_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">Buku dengan stok 0 tidak dapat dipinjam.</div>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_pinjam" class="form-label fw-bold">Tanggal Pinjam <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control @error('tanggal_pinjam') is-invalid @enderror" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}">
                        @error('tanggal_pinjam') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text">Batas pengembalian adalah 7 hari dari tanggal pinjam.</div>
                    </div>

                    <div class="mb-4">
                        <label for="keterangan" class="form-label fw-bold">Keterangan (Opsional)</label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="form-control @error('keterangan') is-invalid @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary rounded-pill fw-bold py-2 shadow-sm">
                            <i class="bi bi-save me-2"></i>Proses Peminjaman
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

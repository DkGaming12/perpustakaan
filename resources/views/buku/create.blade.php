@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card p-4 border border-light shadow-sm bg-white">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h3 class="fw-bold text-dark mb-0">
                    <i class="bi bi-plus-circle-fill text-primary me-2"></i> Tambah Buku Baru
                </h3>
                <span class="text-muted small">* Wajib diisi</span>
            </div>
            
            <form action="{{ route('buku.store') }}" method="POST">
                @csrf
                
                <div class="row g-3">
                    {{-- Kode Buku --}}
                    <div class="col-md-4">
                        <label for="kode_buku" class="form-label fw-semibold">Kode Buku <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="kode_buku" 
                               id="kode_buku" 
                               class="form-control @error('kode_buku') is-invalid @enderror"
                               value="{{ old('kode_buku') }}"
                               placeholder="Contoh: BK-001">
                        @error('kode_buku')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- Judul Buku --}}
                    <div class="col-md-8">
                        <label for="judul" class="form-label fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="judul" 
                               id="judul" 
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul') }}"
                               placeholder="Masukkan judul lengkap buku">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="col-md-4">
                        <label for="kategori" class="form-label fw-semibold">Kategori <span class="text-danger">*</span></label>
                        <select name="kategori" id="kategori" class="form-select @error('kategori') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach (['Programming', 'Database', 'Web Design', 'Networking', 'Data Science'] as $kat)
                                <option value="{{ $kat }}" {{ old('kategori') == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pengarang --}}
                    <div class="col-md-4">
                        <label for="pengarang" class="form-label fw-semibold">Pengarang <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="pengarang" 
                               id="pengarang" 
                               class="form-control @error('pengarang') is-invalid @enderror"
                               value="{{ old('pengarang') }}"
                               placeholder="Nama penulis/pengarang">
                        @error('pengarang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Penerbit --}}
                    <div class="col-md-4">
                        <label for="penerbit" class="form-label fw-semibold">Penerbit <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="penerbit" 
                               id="penerbit" 
                               class="form-control @error('penerbit') is-invalid @enderror"
                               value="{{ old('penerbit') }}"
                               placeholder="Nama perusahaan penerbit">
                        @error('penerbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tahun Terbit --}}
                    <div class="col-md-3">
                        <label for="tahun_terbit" class="form-label fw-semibold">Tahun Terbit <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="tahun_terbit" 
                               id="tahun_terbit" 
                               class="form-control @error('tahun_terbit') is-invalid @enderror"
                               value="{{ old('tahun_terbit', date('Y')) }}"
                               min="1900"
                               max="{{ date('Y') }}">
                        @error('tahun_terbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ISBN --}}
                    <div class="col-md-3">
                        <label for="isbn" class="form-label fw-semibold">ISBN</label>
                        <input type="text" 
                               name="isbn" 
                               id="isbn" 
                               class="form-control @error('isbn') is-invalid @enderror"
                               value="{{ old('isbn') }}"
                               placeholder="978-xxx-xxx">
                        @error('isbn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Bahasa --}}
                    <div class="col-md-2">
                        <label for="bahasa" class="form-label fw-semibold">Bahasa <span class="text-danger">*</span></label>
                        <select name="bahasa" id="bahasa" class="form-select @error('bahasa') is-invalid @enderror">
                            <option value="Indonesia" {{ old('bahasa', 'Indonesia') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                            <option value="Inggris" {{ old('bahasa') == 'Inggris' ? 'selected' : '' }}>Inggris</option>
                        </select>
                        @error('bahasa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="col-md-2">
                        <label for="harga" class="form-label fw-semibold">Harga <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="harga" 
                               id="harga" 
                               class="form-control @error('harga') is-invalid @enderror"
                               value="{{ old('harga', 0) }}"
                               min="0">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div class="col-md-2">
                        <label for="stok" class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                        <input type="number" 
                               name="stok" 
                               id="stok" 
                               class="form-control @error('stok') is-invalid @enderror"
                               value="{{ old('stok', 0) }}"
                               min="0">
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-md-12">
                        <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" 
                                  id="deskripsi" 
                                  rows="4" 
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  placeholder="Tuliskan deskripsi singkat buku...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">
                    <a href="{{ route('buku.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan Buku
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

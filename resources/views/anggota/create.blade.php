@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card p-4 border border-light shadow-sm bg-white">
            <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                <h3 class="fw-bold text-dark mb-0">
                    <i class="bi bi-person-plus-fill text-success me-2"></i> Tambah Anggota Baru
                </h3>
                <span class="text-muted small">* Wajib diisi</span>
            </div>
            
            <form action="{{ route('anggota.store') }}" method="POST">
                @csrf
                
                <div class="row g-3">
                    {{-- Kode Anggota --}}
                    <div class="col-md-4">
                        <label for="kode_anggota" class="form-label fw-semibold">Kode Anggota <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="kode_anggota" 
                               id="kode_anggota" 
                               class="form-control @error('kode_anggota') is-invalid @enderror"
                               value="{{ old('kode_anggota') }}"
                               placeholder="Contoh: AGT-001">
                        @error('kode_anggota')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    {{-- Nama Lengkap --}}
                    <div class="col-md-8">
                        <label for="nama" class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="nama" 
                               id="nama" 
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}"
                               placeholder="Masukkan nama lengkap anggota">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Alamat Email <span class="text-danger">*</span></label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}"
                               placeholder="nama@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Telepon --}}
                    <div class="col-md-6">
                        <label for="telepon" class="form-label fw-semibold">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="telepon" 
                               id="telepon" 
                               class="form-control @error('telepon') is-invalid @enderror"
                               value="{{ old('telepon') }}"
                               placeholder="Contoh: 0812xxxxxxxx">
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="col-md-4">
                        <label for="tanggal_lahir" class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" 
                               name="tanggal_lahir" 
                               id="tanggal_lahir" 
                               class="form-control @error('tanggal_lahir') is-invalid @enderror"
                               value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="col-md-4">
                        <label for="jenis_kelamin" class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pekerjaan --}}
                    <div class="col-md-4">
                        <label for="pekerjaan" class="form-label fw-semibold">Pekerjaan</label>
                        <input type="text" 
                               name="pekerjaan" 
                               id="pekerjaan" 
                               class="form-control @error('pekerjaan') is-invalid @enderror"
                               value="{{ old('pekerjaan') }}"
                               placeholder="Pekerjaan saat ini (opsional)">
                        @error('pekerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Daftar --}}
                    <div class="col-md-6">
                        <label for="tanggal_daftar" class="form-label fw-semibold">Tanggal Daftar <span class="text-danger">*</span></label>
                        <input type="date" 
                               name="tanggal_daftar" 
                               id="tanggal_daftar" 
                               class="form-control @error('tanggal_daftar') is-invalid @enderror"
                               value="{{ old('tanggal_daftar', date('Y-m-d')) }}">
                        @error('tanggal_daftar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="col-md-6">
                        <label for="status" class="form-label fw-semibold">Status Keanggotaan <span class="text-danger">*</span></label>
                        <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="Aktif" {{ old('status', 'Aktif') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ old('status') == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="col-md-12">
                        <label for="alamat" class="form-label fw-semibold">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat" 
                                  id="alamat" 
                                  rows="3" 
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  placeholder="Tuliskan alamat lengkap tinggal saat ini...">{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">
                    <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-success rounded-pill px-4 shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan Anggota
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

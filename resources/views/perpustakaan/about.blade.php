@extends('layouts.app')

@section('title', 'Tentang Aplikasi')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card p-5 shadow-sm text-center">
            <div class="d-inline-block p-4 bg-primary-subtle text-primary rounded-circle mb-4 mx-auto" style="width: 100px; height: 100px;">
                <i class="bi bi-info-circle-fill fs-1"></i>
            </div>
            
            <h1 class="fw-bold mb-2">{{ $info['nama'] }}</h1>
            <p class="text-secondary mb-4 fs-5">Versi {{ $info['versi'] }}</p>
            
            <div class="alert alert-light border p-3 mb-4 rounded text-start">
                <h5 class="fw-bold text-dark mb-2">Deskripsi</h5>
                <p class="mb-0 text-muted">{{ $info['deskripsi'] }}</p>
            </div>
            
            <div class="row g-3 text-start">
                <div class="col-sm-6">
                    <div class="p-3 bg-light rounded border border-light h-100">
                        <small class="text-muted d-block uppercase mb-1">Developer</small>
                        <strong class="text-dark">{{ $info['developer'] }}</strong>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="p-3 bg-light rounded border border-light h-100">
                        <small class="text-muted d-block uppercase mb-1">NIM</small>
                        <strong class="text-dark">{{ $info['nim'] }}</strong>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="p-3 bg-light rounded border border-light h-100">
                        <small class="text-muted d-block uppercase mb-1">Prodi</small>
                        <strong class="text-dark">{{ $info['prodi'] }}</strong>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="p-3 bg-light rounded border border-light h-100">
                        <small class="text-muted d-block uppercase mb-1">Tahun Rilis</small>
                        <strong class="text-dark">&copy; {{ $info['tahun'] }}</strong>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-3">
                <a href="{{ route('perpus.index') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-journal-bookmark me-1"></i> Mulai Menjelajah
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

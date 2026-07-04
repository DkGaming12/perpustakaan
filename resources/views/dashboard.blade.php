@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0"><i class="bi bi-speedometer2 me-2 text-primary"></i>Dashboard Perpustakaan</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('transaksi.create') }}" class="btn btn-warning rounded-pill px-3 shadow-sm fw-semibold">
            <i class="bi bi-cart-plus me-1"></i> Pinjam Buku
        </a>
        <a href="{{ route('buku.create') }}" class="btn btn-primary rounded-pill px-3 shadow-sm fw-semibold">
            <i class="bi bi-plus-circle me-1"></i> Tambah Buku
        </a>
    </div>
</div>

<!-- 6 Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4 col-lg-2 animate-in">
        <div class="card border-0 text-white h-100 p-3" style="background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);">
            <div class="card-body p-0 d-flex flex-column justify-content-center">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="bi bi-journal-bookmark fs-4 opacity-75"></i>
                    <span class="text-white-50 small fw-semibold text-uppercase">Total Buku</span>
                </div>
                <h2 class="mb-0 fw-bold">{{ $totalBuku }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2 animate-in">
        <div class="card border-0 text-white h-100 p-3" style="background: linear-gradient(135deg, #06d6a0 0%, #028a6b 100%);">
            <div class="card-body p-0 d-flex flex-column justify-content-center">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="bi bi-people fs-4 opacity-75"></i>
                    <span class="text-white-50 small fw-semibold text-uppercase">Anggota</span>
                </div>
                <h2 class="mb-0 fw-bold">{{ $totalAnggota }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2 animate-in">
        <div class="card border-0 text-white h-100 p-3" style="background: linear-gradient(135deg, #f77f00 0%, #d62828 100%);">
            <div class="card-body p-0 d-flex flex-column justify-content-center">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="bi bi-cart fs-4 opacity-75"></i>
                    <span class="text-white-50 small fw-semibold text-uppercase">Dipinjam</span>
                </div>
                <h2 class="mb-0 fw-bold">{{ $bukuDipinjam }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2 animate-in">
        <div class="card border-0 text-white h-100 p-3" style="background: linear-gradient(135deg, #ef476f 0%, #b5113a 100%);">
            <div class="card-body p-0 d-flex flex-column justify-content-center">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="bi bi-exclamation-octagon fs-4 opacity-75"></i>
                    <span class="text-white-50 small fw-semibold text-uppercase">Terlambat</span>
                </div>
                <h2 class="mb-0 fw-bold">{{ $bukuTerlambat }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2 animate-in">
        <div class="card border-0 text-white h-100 p-3" style="background: linear-gradient(135deg, #7209b7 0%, #560bad 100%);">
            <div class="card-body p-0 d-flex flex-column justify-content-center">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="bi bi-arrow-left-right fs-4 opacity-75"></i>
                    <span class="text-white-50 small fw-semibold text-uppercase">Transaksi</span>
                </div>
                <h2 class="mb-0 fw-bold">{{ $totalTransaksi }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-lg-2 animate-in">
        <div class="card border-0 text-white h-100 p-3" style="background: linear-gradient(135deg, #118ab2 0%, #073b4c 100%);">
            <div class="card-body p-0 d-flex flex-column justify-content-center">
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="bi bi-cash-coin fs-4 opacity-75"></i>
                    <span class="text-white-50 small fw-semibold text-uppercase">Denda</span>
                </div>
                <h3 class="mb-0 fw-bold" style="font-size:1.2rem;">Rp {{ number_format($totalDenda, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-4 mb-4">
    <!-- Line Chart: Trend Peminjaman -->
    <div class="col-lg-8 animate-in">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 py-3">
                <h6 class="fw-bold text-secondary mb-0"><i class="bi bi-graph-up me-2 text-primary"></i>Trend Peminjaman (6 Bulan)</h6>
            </div>
            <div class="card-body">
                <canvas id="trendChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <!-- Pie Chart: Kategori Buku -->
    <div class="col-lg-4 animate-in">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 py-3">
                <h6 class="fw-bold text-secondary mb-0"><i class="bi bi-pie-chart me-2 text-success"></i>Distribusi Kategori</h6>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <canvas id="kategoriChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Bar Chart: Top 5 Buku -->
    <div class="col-lg-6 animate-in">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 py-3">
                <h6 class="fw-bold text-secondary mb-0"><i class="bi bi-bar-chart me-2 text-warning"></i>Top 5 Buku Terpopuler</h6>
            </div>
            <div class="card-body">
                <canvas id="topBukuChart" height="160"></canvas>
            </div>
        </div>
    </div>
    <!-- Donut Chart: Status Transaksi -->
    <div class="col-lg-6 animate-in">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 py-3">
                <h6 class="fw-bold text-secondary mb-0"><i class="bi bi-circle-half me-2 text-info"></i>Status Transaksi</h6>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <canvas id="statusChart" height="160"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Data Tables Row -->
<div class="row g-4 mb-4">
    <!-- Transaksi Terbaru -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-transparent border-0 py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-secondary mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Transaksi Terbaru</h6>
                <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-4 py-3">Kode</th>
                                <th class="py-3">Anggota</th>
                                <th class="py-3">Buku</th>
                                <th class="py-3">Pinjam</th>
                                <th class="py-3 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTransaksi as $trx)
                            <tr>
                                <td class="px-4 py-3 fw-semibold text-primary">#{{ $trx->kode_transaksi }}</td>
                                <td class="py-3">{{ $trx->anggota->nama }}</td>
                                <td class="py-3 text-truncate" style="max-width: 150px;">{{ $trx->buku->judul }}</td>
                                <td class="py-3">{{ $trx->tanggal_pinjam->format('d M') }}</td>
                                <td class="py-3 text-center">{!! $trx->status_badge !!}</td>
                            </tr>
                            @empty
                            <tr><td colspan="5" class="text-center py-4 text-muted">Belum ada transaksi</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Buku Terbaru -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-transparent border-0 py-3">
                <h6 class="fw-bold text-secondary mb-0"><i class="bi bi-journal-plus me-2 text-success"></i>Buku Baru Ditambahkan</h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    @forelse($recentBooks as $b)
                    <div class="list-group-item px-4 py-3 d-flex justify-content-between align-items-center border-0">
                        <div>
                            <h6 class="mb-1 fw-bold">{{ $b->judul }}</h6>
                            <small class="text-muted"><i class="bi bi-person me-1"></i>{{ $b->pengarang }}</small>
                        </div>
                        <span class="badge bg-light text-dark border rounded-pill">{{ $b->kategori }}</span>
                    </div>
                    @empty
                    <div class="list-group-item text-center py-4 text-muted border-0">Belum ada data buku</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Anggota Terlambat -->
@if($lateTx->count() > 0)
<div class="card border-0 shadow-sm border-start border-danger border-3">
    <div class="card-header bg-danger bg-opacity-10 border-0 py-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold text-danger mb-0"><i class="bi bi-exclamation-circle-fill me-2"></i>Anggota Terlambat Kembali</h6>
        <span class="badge bg-danger rounded-pill">{{ $bukuTerlambat }} Orang</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">Nama Anggota</th>
                        <th class="py-3">Buku</th>
                        <th class="py-3 text-center">Batas Kembali</th>
                        <th class="px-4 py-3 text-end">Terlambat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lateTx as $lt)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="fw-bold">{{ $lt->anggota->nama }}</div>
                            <small class="text-muted">{{ $lt->anggota->kode_anggota }}</small>
                        </td>
                        <td class="py-3 text-truncate" style="max-width: 150px;">{{ $lt->buku->judul }}</td>
                        <td class="py-3 text-center">{{ $lt->tanggal_kembali->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-end">
                            <span class="badge bg-danger rounded-pill px-3 py-1">{{ $lt->terlambat }} Hari</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    // Chart.js defaults for dark mode
    const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
    const textColor = isDark ? '#a0a3b1' : '#6c757d';
    const gridColor = isDark ? 'rgba(255,255,255,0.06)' : 'rgba(0,0,0,0.06)';

    Chart.defaults.color = textColor;
    Chart.defaults.borderColor = gridColor;

    // 1. Line Chart - Trend Peminjaman
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: @json($trendLabels),
            datasets: [{
                label: 'Peminjaman',
                data: @json($trendData),
                borderColor: '#4361ee',
                backgroundColor: 'rgba(67,97,238,0.1)',
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#4361ee',
                pointBorderColor: '#fff',
                pointBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    // 2. Pie Chart - Kategori Buku
    new Chart(document.getElementById('kategoriChart'), {
        type: 'pie',
        data: {
            labels: @json($kategoriLabels),
            datasets: [{
                data: @json($kategoriData),
                backgroundColor: @json(array_slice($kategoriColors, 0, count($kategoriLabels))),
                borderWidth: 2,
                borderColor: isDark ? '#1e1e2f' : '#fff'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom', labels: { padding: 12, usePointStyle: true } } }
        }
    });

    // 3. Bar Chart - Top 5 Buku
    new Chart(document.getElementById('topBukuChart'), {
        type: 'bar',
        data: {
            labels: @json($topBukuLabels),
            datasets: [{
                label: 'Kali Dipinjam',
                data: @json($topBukuData),
                backgroundColor: ['#4361ee', '#3a86ff', '#8338ec', '#ff006e', '#fb5607'],
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            plugins: { legend: { display: false } },
            scales: { x: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    // 4. Donut Chart - Status Transaksi
    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Dipinjam', 'Dikembalikan'],
            datasets: [{
                data: [{{ $statusDipinjam }}, {{ $statusDikembalikan }}],
                backgroundColor: ['#f77f00', '#06d6a0'],
                borderWidth: 3,
                borderColor: isDark ? '#1e1e2f' : '#fff'
            }]
        },
        options: {
            responsive: true,
            cutout: '60%',
            plugins: { legend: { position: 'bottom', labels: { padding: 12, usePointStyle: true } } }
        }
    });
</script>
@endsection

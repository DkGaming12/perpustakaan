<!DOCTYPE html>
<html lang="id" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Perpustakaan') - Perpustakaan</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            --card-bg: #ffffff;
            --body-bg: #f0f2f5;
            --text-primary: #1a1a2e;
            --text-secondary: #6c757d;
            --border-color: #e9ecef;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.08);
            --shadow-md: 0 4px 15px rgba(0,0,0,0.08);
            --navbar-bg: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }

        [data-bs-theme="dark"] {
            --card-bg: #1e1e2f;
            --body-bg: #121220;
            --text-primary: #e4e6eb;
            --text-secondary: #a0a3b1;
            --border-color: #2d2d44;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.3);
            --shadow-md: 0 4px 15px rgba(0,0,0,0.3);
            --navbar-bg: linear-gradient(135deg, #0d0d1a 0%, #111127 100%);
        }

        * { font-family: 'Inter', sans-serif; }

        body {
            background: var(--body-bg);
            color: var(--text-primary);
            transition: background 0.3s ease, color 0.3s ease;
        }

        /* Navbar */
        .main-navbar {
            background: var(--navbar-bg);
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 0.6rem 0;
        }
        .main-navbar .navbar-brand { font-weight: 700; letter-spacing: -0.3px; }
        .main-navbar .nav-link {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: rgba(255,255,255,0.7) !important;
            font-weight: 500;
            font-size: 0.85rem;
            padding: 0.5rem 0.6rem !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .main-navbar .nav-link:hover,
        .main-navbar .nav-link.active {
            color: #fff !important;
            background: rgba(255,255,255,0.1);
        }
        .main-navbar .nav-link.active { font-weight: 600; }

        /* Global search */
        .global-search {
            position: relative;
            min-width: 220px;
            max-width: 260px;
        }
        .global-search input {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.15);
            color: #fff;
            font-size: 0.85rem;
            padding: 0.45rem 0.75rem 0.45rem 2.2rem;
            border-radius: 10px;
            transition: all 0.2s ease;
            width: 100%;
        }
        .global-search input::placeholder { color: rgba(255,255,255,0.5); }
        .global-search input:focus {
            background: rgba(255,255,255,0.15);
            border-color: rgba(255,255,255,0.3);
            box-shadow: 0 0 0 3px rgba(255,255,255,0.08);
            color: #fff;
        }
        .global-search .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255,255,255,0.5);
            font-size: 0.85rem;
        }

        /* Cards */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 14px;
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
        }
        .card:hover { box-shadow: var(--shadow-md); }

        /* Content area */
        .content-wrapper {
            background: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow-sm);
            padding: 1.5rem;
            transition: background 0.3s ease;
        }

        /* Buttons - touch friendly */
        .btn { min-height: 38px; border-radius: 10px; font-weight: 500; transition: all 0.2s ease; }
        .btn:hover { transform: translateY(-1px); }
        .btn:active { transform: translateY(0); }
        .btn-sm { min-height: 34px; min-width: 34px; }

        /* Tables */
        .table { color: var(--text-primary); }
        .table th { font-weight: 600; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .table td { vertical-align: middle; }
        .table-hover tbody tr { transition: background 0.15s ease; }

        /* Dark mode toggle */
        .theme-toggle {
            cursor: pointer;
            padding: 0.4rem 0.6rem;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.15);
            background: rgba(255,255,255,0.08);
            color: rgba(255,255,255,0.8);
            transition: all 0.2s ease;
            font-size: 1rem;
            display: flex;
            align-items: center;
        }
        .theme-toggle:hover { background: rgba(255,255,255,0.15); color: #fff; }

        /* User dropdown */
        .user-dropdown .btn {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.85);
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
        }
        .user-dropdown .btn:hover { background: rgba(255,255,255,0.15); color: #fff; }
        .user-dropdown .dropdown-menu {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: var(--shadow-md);
        }
        .user-dropdown .dropdown-item {
            color: var(--text-primary);
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
        }
        .user-dropdown .dropdown-item:hover { background: rgba(0,0,0,0.05); }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-in { animation: fadeInUp 0.4s ease forwards; }
        .animate-in:nth-child(1) { animation-delay: 0.05s; }
        .animate-in:nth-child(2) { animation-delay: 0.1s; }
        .animate-in:nth-child(3) { animation-delay: 0.15s; }
        .animate-in:nth-child(4) { animation-delay: 0.2s; }

        /* Loading overlay */
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.3);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
        .loading-overlay.active { display: flex; }
        .loading-spinner {
            width: 48px; height: 48px;
            border: 4px solid rgba(255,255,255,0.3);
            border-top: 4px solid #fff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Badge animations */
        .badge { transition: all 0.2s ease; }

        /* Alert animation */
        .alert { animation: fadeInUp 0.3s ease; }

        /* Responsive tables */
        @media (max-width: 768px) {
            .content-wrapper { padding: 1rem; border-radius: 12px; }
            .table-responsive { margin: 0 -0.5rem; }
            .btn-group .btn { padding: 0.4rem 0.5rem; }
            .main-navbar .nav-link { padding: 0.6rem 1rem !important; }
        }

        /* Dark mode specific overrides */
        [data-bs-theme="dark"] .card { border-color: var(--border-color); }
        [data-bs-theme="dark"] .table-light { background: rgba(255,255,255,0.05) !important; }
        [data-bs-theme="dark"] .table-light th { color: var(--text-secondary) !important; }
        [data-bs-theme="dark"] .bg-white { background: var(--card-bg) !important; }
        [data-bs-theme="dark"] .bg-light { background: rgba(255,255,255,0.05) !important; }
        [data-bs-theme="dark"] .text-dark { color: var(--text-primary) !important; }
        [data-bs-theme="dark"] .text-muted { color: var(--text-secondary) !important; }
        [data-bs-theme="dark"] .text-secondary { color: var(--text-secondary) !important; }
        [data-bs-theme="dark"] .border-light { border-color: var(--border-color) !important; }
        [data-bs-theme="dark"] .form-control,
        [data-bs-theme="dark"] .form-select {
            background: rgba(255,255,255,0.05);
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        [data-bs-theme="dark"] .list-group-item {
            background: var(--card-bg);
            border-color: var(--border-color);
            color: var(--text-primary);
        }
        [data-bs-theme="dark"] .modal-content {
            background: var(--card-bg);
            border-color: var(--border-color);
        }
        [data-bs-theme="dark"] .input-group-text {
            background: rgba(255,255,255,0.05);
            border-color: var(--border-color);
            color: var(--text-secondary);
        }
        [data-bs-theme="dark"] .card-header {
            border-color: var(--border-color);
        }
        [data-bs-theme="dark"] .breadcrumb-item a { color: #6ea8fe; }
        [data-bs-theme="dark"] .breadcrumb-item.active { color: var(--text-secondary); }

        /* Print friendly */
        @media print {
            .main-navbar, .theme-toggle, .user-dropdown, .global-search { display: none !important; }
            .content-wrapper { box-shadow: none; border: none; }
            body { background: #fff; }
        }

        @yield('styles')
    </style>
</head>
<body>

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg main-navbar shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center text-white" href="{{ route('dashboard') }}">
                <i class="bi bi-book-half me-2"></i> Sistem Perpustakaan
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('buku.*') || Route::is('perpus.*') ? 'active' : '' }}" href="{{ route('buku.index') }}">
                            <i class="bi bi-book"></i> Buku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('anggota.*') ? 'active' : '' }}" href="{{ route('anggota.index') }}">
                            <i class="bi bi-people"></i> Anggota
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('kategori.*') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                            <i class="bi bi-tags"></i> Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('transaksi.*') && !Route::is('transaksi.laporan') && !Route::is('transaksi.export_pdf') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">
                            <i class="bi bi-arrow-left-right"></i> Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('transaksi.laporan') ? 'active' : '' }}" href="{{ route('transaksi.laporan') }}">
                            <i class="bi bi-file-earmark-bar-graph"></i> Laporan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('perpus.about') ? 'active' : '' }}" href="{{ route('perpus.about') }}">
                            <i class="bi bi-info-circle"></i> About
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <!-- Global Search -->
                    <form action="{{ route('search') }}" method="GET" class="global-search d-none d-lg-block">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" name="q" class="form-control" placeholder="Cari buku, anggota..." value="{{ request('q') }}">
                    </form>

                    <!-- Dark Mode Toggle -->
                    <button class="theme-toggle" id="themeToggle" title="Toggle Dark Mode">
                        <i class="bi bi-moon-fill" id="themeIcon"></i>
                    </button>

                    <!-- User Dropdown -->
                    <div class="user-dropdown dropdown">
                        <button class="btn dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i>
                            <span class="d-none d-md-inline">{{ Auth::user()->name ?? 'User' }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end mt-2 p-2">
                            <li>
                                <span class="dropdown-item disabled">
                                    <i class="bi bi-envelope me-2"></i>{{ Auth::user()->email ?? '' }}
                                </span>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container pb-5">
        {{-- Flash Messages --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="content-wrapper">
            @yield('content')
        </div>
    </main>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dark Mode Script -->
    <script>
        (function() {
            const toggle = document.getElementById('themeToggle');
            const icon = document.getElementById('themeIcon');
            const html = document.documentElement;

            // Load saved theme
            const saved = localStorage.getItem('theme') || 'light';
            html.setAttribute('data-bs-theme', saved);
            icon.className = saved === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';

            toggle.addEventListener('click', function() {
                const current = html.getAttribute('data-bs-theme');
                const next = current === 'dark' ? 'light' : 'dark';
                html.setAttribute('data-bs-theme', next);
                localStorage.setItem('theme', next);
                icon.className = next === 'dark' ? 'bi bi-sun-fill' : 'bi bi-moon-fill';
            });
        })();

        // Loading overlay for forms
        document.querySelectorAll('form[method="POST"], form[method="post"]').forEach(function(form) {
            form.addEventListener('submit', function() {
                if (form.checkValidity()) {
                    setTimeout(function() {
                        document.getElementById('loadingOverlay').classList.add('active');
                    }, 100);
                }
            });
        });
    </script>

    @yield('scripts')
</body>
</html>

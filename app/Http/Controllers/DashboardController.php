<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Kategori;
use App\Models\Transaksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Render the main dashboard page with 6+ stats and chart data.
     */
    public function index()
    {
        // ===== 6 STATISTICS =====
        $totalBuku       = Buku::count();
        $totalAnggota    = Anggota::count();
        $bukuDipinjam    = Transaksi::where('status', 'Dipinjam')->count();
        $bukuTerlambat   = Transaksi::where('status', 'Dipinjam')
                               ->where('tanggal_kembali', '<', now())
                               ->count();
        $totalTransaksi  = Transaksi::count();
        $totalDenda      = Transaksi::where('status', 'Dikembalikan')
                               ->where('denda', '>', 0)
                               ->sum('denda');

        // ===== CHART DATA =====

        // 1. Line Chart: Trend peminjaman 6 bulan terakhir
        $trendLabels = [];
        $trendData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $trendLabels[] = $date->translatedFormat('M Y');
            $trendData[] = Transaksi::whereMonth('tanggal_pinjam', $date->month)
                                     ->whereYear('tanggal_pinjam', $date->year)
                                     ->count();
        }

        // 2. Pie Chart: Distribusi kategori buku
        $kategoriLabels = [];
        $kategoriData = [];
        $kategoriColors = ['#4361ee', '#3a86ff', '#8338ec', '#ff006e', '#fb5607', '#ffbe0b', '#06d6a0', '#118ab2'];
        $kategoris = Buku::select('kategori')
                         ->selectRaw('COUNT(*) as total')
                         ->groupBy('kategori')
                         ->orderByDesc('total')
                         ->get();
        foreach ($kategoris as $i => $k) {
            $kategoriLabels[] = $k->kategori;
            $kategoriData[] = $k->total;
        }

        // 3. Bar Chart: Top 5 buku terpopuler (paling sering dipinjam)
        $topBukuLabels = [];
        $topBukuData = [];
        $topBukus = Transaksi::select('buku_id')
                             ->selectRaw('COUNT(*) as total')
                             ->groupBy('buku_id')
                             ->orderByDesc('total')
                             ->take(5)
                             ->with('buku')
                             ->get();
        foreach ($topBukus as $tb) {
            $topBukuLabels[] = \Illuminate\Support\Str::limit($tb->buku->judul ?? '-', 20);
            $topBukuData[] = $tb->total;
        }

        // 4. Donut Chart: Status transaksi
        $statusDipinjam = Transaksi::where('status', 'Dipinjam')->count();
        $statusDikembalikan = Transaksi::where('status', 'Dikembalikan')->count();

        // ===== RECENT DATA =====
        $recentTransaksi = Transaksi::with(['anggota', 'buku'])
                                     ->latest()
                                     ->take(5)
                                     ->get();

        $recentBooks = Buku::latest()->take(5)->get();

        // ===== LATE LOANS =====
        $lateTx = Transaksi::with(['anggota', 'buku'])
                            ->where('status', 'Dipinjam')
                            ->where('tanggal_kembali', '<', now())
                            ->orderBy('tanggal_kembali', 'asc')
                            ->take(5)
                            ->get();

        return view('dashboard', compact(
            'totalBuku', 'totalAnggota', 'bukuDipinjam', 'bukuTerlambat',
            'totalTransaksi', 'totalDenda',
            'trendLabels', 'trendData',
            'kategoriLabels', 'kategoriData', 'kategoriColors',
            'topBukuLabels', 'topBukuData',
            'statusDipinjam', 'statusDikembalikan',
            'recentTransaksi', 'recentBooks', 'lateTx'
        ));
    }
}

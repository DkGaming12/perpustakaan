<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PerpustakaanController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SearchController;

// ===========================================================================
// PUBLIC ROUTES (No Login Required)
// ===========================================================================

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ===========================================================================
// AUTHENTICATED ROUTES (Login Required)
// ===========================================================================
Route::middleware('auth')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // PERPUSTAKAAN (Public view dari dalam app)
    Route::get('/perpustakaan', [PerpustakaanController::class, 'index'])->name('perpus.index');
    Route::get('/perpustakaan/{id}', [PerpustakaanController::class, 'show'])->name('perpus.show');
    Route::get('/about', [PerpustakaanController::class, 'about'])->name('perpus.about');

    // GLOBAL SEARCH
    Route::get('/search', [SearchController::class, 'index'])->name('search');

    // BUKU RESOURCE CRUD
    Route::get('/buku/export', [BukuController::class, 'export'])->name('buku.export');
    Route::resource('buku', BukuController::class);

    // ANGGOTA RESOURCE CRUD
    Route::get('/anggota/export', [AnggotaController::class, 'export'])->name('anggota.export');
    Route::resource('anggota', AnggotaController::class);

    // KATEGORI RESOURCE CRUD
    Route::resource('kategori', KategoriController::class);

    // TRANSAKSI
    Route::get('/transaksi/laporan', [TransaksiController::class, 'laporan'])->name('transaksi.laporan');
    Route::get('/transaksi/laporan/pdf', [TransaksiController::class, 'exportPdf'])->name('transaksi.export_pdf');
    Route::resource('transaksi', TransaksiController::class);
    Route::put('/transaksi/{id}/kembalikan', [TransaksiController::class, 'kembalikan'])->name('transaksi.kembalikan');
});

// ===========================================================================
// DEVELOPMENT & TESTING ROUTES
// ===========================================================================
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        return "<h2>✅ Koneksi database berhasil!</h2><p>Database: <strong>{$dbName}</strong></p>";
    } catch (\Exception $e) {
        return "<h2>❌ Koneksi database gagal!</h2><p>Error: " . $e->getMessage() . '</p>';
    }
})->name('test.db');

require __DIR__.'/auth.php';

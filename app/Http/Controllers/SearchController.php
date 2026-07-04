<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Transaksi;

class SearchController extends Controller
{
    /**
     * Global search across Buku, Anggota, and Transaksi modules.
     */
    public function index(Request $request)
    {
        $keyword = $request->get('q', '');
        $tab = $request->get('tab', 'buku');

        $bukuResults = collect();
        $anggotaResults = collect();
        $transaksiResults = collect();

        if ($keyword) {
            // Search Buku
            $bukuResults = Buku::where('judul', 'like', "%{$keyword}%")
                ->orWhere('pengarang', 'like', "%{$keyword}%")
                ->orWhere('kode_buku', 'like', "%{$keyword}%")
                ->orWhere('kategori', 'like', "%{$keyword}%")
                ->orWhere('penerbit', 'like', "%{$keyword}%")
                ->orWhere('isbn', 'like', "%{$keyword}%")
                ->orderBy('judul')
                ->take(20)
                ->get();

            // Search Anggota
            $anggotaResults = Anggota::where('nama', 'like', "%{$keyword}%")
                ->orWhere('kode_anggota', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%")
                ->orWhere('telepon', 'like', "%{$keyword}%")
                ->orWhere('alamat', 'like', "%{$keyword}%")
                ->orderBy('nama')
                ->take(20)
                ->get();

            // Search Transaksi
            $transaksiResults = Transaksi::with(['anggota', 'buku'])
                ->where('kode_transaksi', 'like', "%{$keyword}%")
                ->orWhere('keterangan', 'like', "%{$keyword}%")
                ->orWhereHas('anggota', function ($q) use ($keyword) {
                    $q->where('nama', 'like', "%{$keyword}%");
                })
                ->orWhereHas('buku', function ($q) use ($keyword) {
                    $q->where('judul', 'like', "%{$keyword}%");
                })
                ->latest()
                ->take(20)
                ->get();
        }

        return view('search.index', compact(
            'keyword', 'tab',
            'bukuResults', 'anggotaResults', 'transaksiResults'
        ));
    }
}

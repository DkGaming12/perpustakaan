<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class PerpustakaanController extends Controller
{
    /**
     * Halaman utama - Daftar Buku (dari database via Eloquent).
     */
    public function index(Request $request)
    {
        $nama_sistem = "Sistem Perpustakaan Laravel";
        $versi       = "12.x";
        
        $query = Buku::query();
        
        if ($request->filled('q')) {
            $query->where('judul', 'like', "%{$request->q}%")
                  ->orWhere('pengarang', 'like', "%{$request->q}%");
        }
        
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }
        
        $buku_list   = $query->orderBy('kode_buku')->paginate(10)->appends($request->query());
        $total_buku  = $buku_list->total(); // Use total() for paginated results

        $kategoriList = Buku::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');

        return view('perpustakaan.index', compact('nama_sistem', 'versi', 'total_buku', 'buku_list', 'kategoriList'));
    }

    /**
     * Detail satu buku (dari database via Eloquent).
     */
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('perpustakaan.show', compact('buku'));
    }

    /**
     * Halaman About - informasi developer.
     */
    public function about()
    {
        $info = [
            'nama'      => 'Sistem Perpustakaan Laravel',
            'versi'     => '1.0.0',
            'deskripsi' => 'Sistem manajemen perpustakaan berbasis Laravel.',
            'developer' => 'Didi Purnomo',
            'nim'       => '60324067',
            'prodi'     => 'Informatika',
            'tahun'     => date('Y'),
        ];

        return view('perpustakaan.about', compact('info'));
    }
}

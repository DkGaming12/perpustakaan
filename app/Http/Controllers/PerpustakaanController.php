<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class PerpustakaanController extends Controller
{
    /**
     * Halaman utama - Daftar Buku (dari database via Eloquent).
     */
    public function index()
    {
        $nama_sistem = "Sistem Perpustakaan Laravel";
        $versi       = "12.x";
        $buku_list   = Buku::orderBy('kode_buku')->get();
        $total_buku  = $buku_list->count();

        return view('perpustakaan.index', compact('nama_sistem', 'versi', 'total_buku', 'buku_list'));
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

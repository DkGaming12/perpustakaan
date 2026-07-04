<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing with search & filter.
     */
    public function index(Request $request)
    {
        $query = Buku::query();

        // Search keyword
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function($q) use ($s) {
                $q->where('judul', 'like', "%{$s}%")
                  ->orWhere('pengarang', 'like', "%{$s}%")
                  ->orWhere('kode_buku', 'like', "%{$s}%")
                  ->orWhere('isbn', 'like', "%{$s}%");
            });
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // Filter by ketersediaan
        if ($request->filled('ketersediaan')) {
            if ($request->ketersediaan === 'tersedia') {
                $query->where('stok', '>', 0);
            } elseif ($request->ketersediaan === 'habis') {
                $query->where('stok', 0);
            }
        }

        // Filter by harga range
        if ($request->filled('harga_min')) {
            $query->where('harga', '>=', $request->harga_min);
        }
        if ($request->filled('harga_max')) {
            $query->where('harga', '<=', $request->harga_max);
        }

        // Get distinct categories for filter dropdown
        $kategoriList = Buku::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');

        $buku_list = $query->orderBy('kode_buku')->paginate(10)->appends($request->query());

        return view('buku.index', compact('buku_list', 'kategoriList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoriList = Buku::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');
        return view('buku.create', compact('kategoriList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBukuRequest $request)
    {
        try {
            Buku::create($request->validated());
            return redirect()->route('buku.index')
                             ->with('success', 'Buku berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal menambahkan buku: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('perpustakaan.show', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategoriList = Buku::select('kategori')->distinct()->orderBy('kategori')->pluck('kategori');
        return view('buku.edit', compact('buku', 'kategoriList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBukuRequest $request, string $id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $buku->update($request->validated());
            return redirect()->route('buku.index')
                             ->with('success', 'Buku berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal memperbarui buku: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $buku = Buku::findOrFail($id);
            $buku->delete();
            return redirect()->route('buku.index')
                             ->with('success', 'Buku berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('buku.index')
                             ->with('error', 'Gagal menghapus buku: ' . $e->getMessage());
        }
    }

    /**
     * Export buku to Excel (CSV format).
     */
    public function export()
    {
        $bukus = Buku::orderBy('kode_buku')->get();

        $filename = 'data-buku-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($bukus) {
            $file = fopen('php://output', 'w');
            // BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            // Header row
            fputcsv($file, ['Kode Buku', 'Judul', 'Kategori', 'Pengarang', 'Penerbit', 'Tahun Terbit', 'ISBN', 'Harga', 'Stok', 'Bahasa'], ';');
            // Data rows
            foreach ($bukus as $b) {
                fputcsv($file, [
                    $b->kode_buku, $b->judul, $b->kategori, $b->pengarang,
                    $b->penerbit, $b->tahun_terbit, $b->isbn,
                    $b->harga, $b->stok, $b->bahasa
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

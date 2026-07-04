<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Buku;

class KategoriController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $kategori_list = Kategori::all()->map(function ($kat) {
            $kat->jumlah_buku = Buku::where('kategori', $kat->nama_kategori)->count();
            return $kat;
        });

        return view('kategori.index', compact('kategori_list'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created category.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        Kategori::create($request->only('nama_kategori', 'deskripsi'));

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified category with its books.
     */
    public function show(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $buku_list = Buku::where('kategori', $kategori->nama_kategori)->get();

        return view('kategori.show', compact('kategori', 'buku_list'));
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified category.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);

        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori,' . $id,
            'deskripsi' => 'nullable|string|max:500',
        ]);

        // Also update buku.kategori if name changed
        $oldName = $kategori->nama_kategori;
        $kategori->update($request->only('nama_kategori', 'deskripsi'));

        if ($oldName !== $request->nama_kategori) {
            Buku::where('kategori', $oldName)->update(['kategori' => $request->nama_kategori]);
        }

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Remove the specified category.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $bukuCount = Buku::where('kategori', $kategori->nama_kategori)->count();

        if ($bukuCount > 0) {
            return redirect()->route('kategori.index')
                             ->with('error', "Tidak dapat menghapus kategori \"{$kategori->nama_kategori}\" karena masih memiliki {$bukuCount} buku.");
        }

        $kategori->delete();

        return redirect()->route('kategori.index')
                         ->with('success', 'Kategori berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Transaksi;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Anggota::query();
        
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where('nama', 'like', "%{$q}%")
                  ->orWhere('kode_anggota', 'like', "%{$q}%");
        }
        
        $anggota_list = $query->orderBy('kode_anggota')->paginate(10);
        return view('anggota.index', compact('anggota_list'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnggotaRequest $request)
    {
        try {
            Anggota::create($request->validated());
            return redirect()->route('anggota.index')
                             ->with('success', 'Anggota berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal menambahkan anggota: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource with its transaction history.
     */
    public function show(Request $request, string $id)
    {
        $agt = Anggota::findOrFail($id);
        
        $query = Transaksi::with('buku')->where('anggota_id', $agt->id);
        
        // Filter by status if provided
        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }
        
        $transaksis = $query->latest()->get();
        
        // Calculate stats
        $totalPinjam = Transaksi::where('anggota_id', $agt->id)->count();
        $totalDenda = Transaksi::where('anggota_id', $agt->id)->where('status', 'Dikembalikan')->sum('denda');
        $sedangPinjam = Transaksi::where('anggota_id', $agt->id)->where('status', 'Dipinjam')->count();
        
        return view('anggota.show', compact('agt', 'transaksis', 'totalPinjam', 'totalDenda', 'sedangPinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $agt = Anggota::findOrFail($id);
        return view('anggota.edit', compact('agt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnggotaRequest $request, string $id)
    {
        try {
            $agt = Anggota::findOrFail($id);
            $agt->update($request->validated());
            return redirect()->route('anggota.index')
                             ->with('success', 'Data anggota berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withInput()
                             ->with('error', 'Gagal memperbarui anggota: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $agt = Anggota::findOrFail($id);
            $agt->delete();
            return redirect()->route('anggota.index')
                             ->with('success', 'Anggota berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('anggota.index')
                             ->with('error', 'Gagal menghapus anggota: ' . $e->getMessage());
        }
    }

    /**
     * Export anggota to Excel (CSV format).
     */
    public function export()
    {
        $anggotas = Anggota::orderBy('kode_anggota')->get();

        $filename = 'data-anggota-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($anggotas) {
            $file = fopen('php://output', 'w');
            // BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            // Header row (gunakan separator ; agar rapi di Excel format Indonesia)
            fputcsv($file, ['Kode Anggota', 'Nama Lengkap', 'Email', 'Telepon', 'Alamat', 'Tanggal Lahir', 'Jenis Kelamin', 'Pekerjaan', 'Tanggal Daftar', 'Status'], ';');
            // Data rows
            foreach ($anggotas as $a) {
                $tgl_lahir = $a->tanggal_lahir ? \Carbon\Carbon::parse($a->tanggal_lahir)->format('Y-m-d') : '';
                $tgl_daftar = $a->tanggal_daftar ? \Carbon\Carbon::parse($a->tanggal_daftar)->format('Y-m-d') : '';
                
                fputcsv($file, [
                    $a->kode_anggota, $a->nama, $a->email, $a->telepon,
                    $a->alamat, $tgl_lahir, $a->jenis_kelamin,
                    $a->pekerjaan, $tgl_daftar, $a->status
                ], ';');
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'buku';

    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_buku',
        'judul',
        'kategori',
        'pengarang',
        'penerbit',
        'negara_penerbit',
        'kota_penerbit',
        'tahun_terbit',
        'isbn',
        'harga',
        'stok',
        'deskripsi',
        'bahasa',
    ];

    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tahun_terbit' => 'integer',
        'harga'        => 'decimal:2',
        'stok'         => 'integer',
    ];

    // ===================================================================
    // ACCESSORS
    // ===================================================================

    /**
     * Format harga ke format Rupiah.
     * Usage: $buku->harga_format
     */
    public function getHargaFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Cek apakah buku tersedia (stok > 0).
     * Usage: $buku->tersedia
     */
    public function getTersediaAttribute(): bool
    {
        return $this->stok > 0;
    }

    /**
     * Badge HTML berdasarkan jumlah stok.
     * Tugas 2 - Accessor status_stok_badge
     * Usage: $buku->status_stok_badge (raw HTML — gunakan {!! !!} di Blade)
     */
    public function getStatusStokBadgeAttribute(): string
    {
        if ($this->stok === 0) {
            return '<span class="badge bg-danger">Habis</span>';
        } elseif ($this->stok <= 5) {
            return '<span class="badge bg-warning text-dark">Menipis</span>';
        } elseif ($this->stok <= 15) {
            return '<span class="badge bg-info text-dark">Sedang</span>';
        } else {
            return '<span class="badge bg-success">Aman</span>';
        }
    }

    /**
     * Label buku baru/lama berdasarkan tahun terbit.
     * Tugas 2 - Accessor tahun_label
     * Usage: $buku->tahun_label
     */
    public function getTahunLabelAttribute(): string
    {
        return $this->tahun_terbit >= 2024 ? 'Buku Baru' : 'Buku Lama';
    }

    // ===================================================================
    // QUERY SCOPES
    // ===================================================================

    /**
     * Filter buku yang stoknya tersedia (> 0).
     * Usage: Buku::tersedia()->get()
     */
    public function scopeTersedia($query)
    {
        return $query->where('stok', '>', 0);
    }

    /**
     * Filter buku berdasarkan kategori.
     * Usage: Buku::kategori('Programming')->get()
     */
    public function scopeKategori($query, string $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Filter buku dengan stok menipis (< 5).
     * Tugas 2 - Scope stokMenipis
     * Usage: Buku::stokMenipis()->get()
     */
    public function scopeStokMenipis($query)
    {
        return $query->where('stok', '<', 5)->where('stok', '>', 0);
    }

    /**
     * Filter buku dalam rentang harga tertentu.
     * Tugas 2 - Scope hargaRange
     * Usage: Buku::hargaRange(100000, 200000)->get()
     */
    public function scopeHargaRange($query, int $min, int $max)
    {
        return $query->whereBetween('harga', [$min, $max]);
    }

    /**
     * Filter buku terbaru (tahun terbit >= 2024).
     * Tugas 2 - Scope terbaru
     * Usage: Buku::terbaru()->get()
     */
    public function scopeTerbaru($query)
    {
        return $query->where('tahun_terbit', '>=', 2024);
    }

    /**
     * Relasi ke tabel transaksi.
     * Satu buku dapat memiliki banyak transaksi (history peminjaman).
     */
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}

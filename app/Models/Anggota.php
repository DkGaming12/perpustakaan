<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Anggota extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     *
     * @var string
     */
    protected $table = 'anggota';

    /**
     * Kolom yang dapat diisi secara mass assignment.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_anggota',
        'nama',
        'email',
        'telepon',
        'alamat',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'tanggal_daftar',
        'status',
    ];

    /**
     * Tipe casting untuk atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_lahir'  => 'date',
        'tanggal_daftar' => 'date',
    ];

    // ===================================================================
    // ACCESSORS
    // ===================================================================

    /**
     * Menghitung umur berdasarkan tanggal lahir.
     * Usage: $anggota->umur
     */
    public function getUmurAttribute(): int
    {
        return Carbon::parse($this->tanggal_lahir)->age;
    }

    /**
     * Menghitung berapa hari sudah menjadi anggota.
     * Usage: $anggota->lama_anggota
     */
    public function getLamaAnggotaAttribute(): int
    {
        return (int) Carbon::parse($this->tanggal_daftar)->diffInDays(now());
    }

    /**
     * Badge HTML berdasarkan status anggota.
     * Tugas 2 - Accessor status_badge
     * Usage: $anggota->status_badge (raw HTML — gunakan {!! !!} di Blade)
     */
    public function getStatusBadgeAttribute(): string
    {
        if ($this->status === 'Aktif') {
            return '<span class="badge bg-success">Aktif</span>';
        }

        return '<span class="badge bg-secondary">Nonaktif</span>';
    }

    /**
     * Kategori usia anggota berdasarkan umur.
     * Tugas 2 - Accessor kategori_usia
     * Usage: $anggota->kategori_usia
     */
    public function getKategoriUsiaAttribute(): string
    {
        $umur = $this->umur;

        if ($umur < 20) {
            return 'Remaja';
        } elseif ($umur <= 50) {
            return 'Dewasa';
        } else {
            return 'Senior';
        }
    }

    // ===================================================================
    // QUERY SCOPES
    // ===================================================================

    /**
     * Filter anggota yang berstatus Aktif.
     * Usage: Anggota::aktif()->get()
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }

    /**
     * Filter anggota berdasarkan jenis kelamin.
     * Usage: Anggota::jenisKelamin('Laki-laki')->get()
     */
    public function scopeJenisKelamin($query, string $jk)
    {
        return $query->where('jenis_kelamin', $jk);
    }

    /**
     * Filter anggota yang mendaftar di bulan ini.
     * Tugas 2 - Scope terdaftarBulanIni
     * Usage: Anggota::terdaftarBulanIni()->get()
     */
    public function scopeTerdaftarBulanIni($query)
    {
        return $query->whereMonth('tanggal_daftar', now()->month)
                     ->whereYear('tanggal_daftar', now()->year);
    }

    /**
     * Relasi ke tabel transaksi.
     * Satu anggota memiliki banyak transaksi.
     */
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}

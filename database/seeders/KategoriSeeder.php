<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengisi data kategori buku (Tugas 1).
     */
    public function run(): void
    {
        $kategoriList = [
            [
                'nama_kategori' => 'Programming',
                'deskripsi'     => 'Buku pemrograman, pengembangan software, dan teknologi informasi',
                'icon'          => 'code-slash',
                'warna'         => 'primary',
            ],
            [
                'nama_kategori' => 'Database',
                'deskripsi'     => 'Buku desain database, SQL, NoSQL, dan manajemen penyimpanan data',
                'icon'          => 'database',
                'warna'         => 'success',
            ],
            [
                'nama_kategori' => 'Web Design',
                'deskripsi'     => 'Buku panduan UI/UX, HTML, CSS, Figma, dan estetika web',
                'icon'          => 'palette',
                'warna'         => 'info',
            ],
            [
                'nama_kategori' => 'Networking',
                'deskripsi'     => 'Buku jaringan komputer, keamanan siber, dan infrastruktur IT',
                'icon'          => 'wifi',
                'warna'         => 'warning',
            ],
            [
                'nama_kategori' => 'Data Science',
                'deskripsi'     => 'Buku analitik data, machine learning, statistika, dan Python',
                'icon'          => 'graph-up',
                'warna'         => 'danger',
            ],
        ];

        foreach ($kategoriList as $k) {
            Kategori::create($k);
        }
    }
}

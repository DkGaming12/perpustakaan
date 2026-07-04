<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Buku;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengisi data buku sample untuk sistem perpustakaan.
     */
    public function run(): void
    {
        $bukuList = [
            [
                'kode_buku'       => 'BK-001',
                'judul'           => 'Laravel 12 untuk Pemula',
                'kategori'        => 'Programming',
                'pengarang'       => 'John Doe',
                'penerbit'        => 'Tech Publisher',
                'negara_penerbit' => 'Indonesia',
                'kota_penerbit'   => 'Jakarta',
                'tahun_terbit'    => 2024,
                'isbn'            => '978-602-1234-56-1',
                'harga'           => 150000,
                'stok'            => 20,
                'deskripsi'       => 'Buku panduan lengkap Laravel 12 dari dasar hingga mahir',
                'bahasa'          => 'Indonesia',
            ],
            [
                'kode_buku'       => 'BK-002',
                'judul'           => 'MySQL Advanced Techniques',
                'kategori'        => 'Database',
                'pengarang'       => 'Jane Smith',
                'penerbit'        => 'Data Press',
                'negara_penerbit' => 'Amerika Serikat',
                'kota_penerbit'   => 'New York',
                'tahun_terbit'    => 2023,
                'isbn'            => '978-602-1234-56-2',
                'harga'           => 175000,
                'stok'            => 15,
                'deskripsi'       => 'Teknik advanced untuk optimasi MySQL database',
                'bahasa'          => 'Inggris',
            ],
            [
                'kode_buku'       => 'BK-003',
                'judul'           => 'Modern Web Design',
                'kategori'        => 'Web Design',
                'pengarang'       => 'Ahmad Yani',
                'penerbit'        => 'Creative Media',
                'negara_penerbit' => 'Indonesia',
                'kota_penerbit'   => 'Bandung',
                'tahun_terbit'    => 2024,
                'isbn'            => '978-602-1234-56-3',
                'harga'           => 120000,
                'stok'            => 25,
                'deskripsi'       => 'Prinsip dan praktik desain web modern',
                'bahasa'          => 'Indonesia',
            ],
            [
                'kode_buku'       => 'BK-004',
                'judul'           => 'Network Security Fundamentals',
                'kategori'        => 'Networking',
                'pengarang'       => 'Robert Johnson',
                'penerbit'        => 'Security Press',
                'negara_penerbit' => 'Amerika Serikat',
                'kota_penerbit'   => 'San Francisco',
                'tahun_terbit'    => 2023,
                'isbn'            => '978-602-1234-56-4',
                'harga'           => 200000,
                'stok'            => 10,
                'deskripsi'       => 'Dasar-dasar keamanan jaringan komputer',
                'bahasa'          => 'Inggris',
            ],
            [
                'kode_buku'       => 'BK-005',
                'judul'           => 'Data Science dengan Python',
                'kategori'        => 'Data Science',
                'pengarang'       => 'Siti Nurhaliza',
                'penerbit'        => 'Analytics Publisher',
                'negara_penerbit' => 'Indonesia',
                'kota_penerbit'   => 'Surabaya',
                'tahun_terbit'    => 2024,
                'isbn'            => '978-602-1234-56-5',
                'harga'           => 180000,
                'stok'            => 18,
                'deskripsi'       => 'Panduan praktis data science menggunakan Python',
                'bahasa'          => 'Indonesia',
            ],
            [
                'kode_buku'       => 'BK-006',
                'judul'           => 'PHP 8 Programming',
                'kategori'        => 'Programming',
                'pengarang'       => 'Budi Raharjo',
                'penerbit'        => 'Code House',
                'negara_penerbit' => 'Indonesia',
                'kota_penerbit'   => 'Yogyakarta',
                'tahun_terbit'    => 2023,
                'isbn'            => '978-602-1234-56-6',
                'harga'           => 130000,
                'stok'            => 0,
                'deskripsi'       => 'Fitur-fitur terbaru PHP 8',
                'bahasa'          => 'Indonesia',
            ],
            [
                'kode_buku'       => 'BK-007',
                'judul'           => 'PostgreSQL Administration',
                'kategori'        => 'Database',
                'pengarang'       => 'David Wilson',
                'penerbit'        => 'Database Pro',
                'negara_penerbit' => 'Inggris',
                'kota_penerbit'   => 'London',
                'tahun_terbit'    => 2024,
                'isbn'            => '978-602-1234-56-7',
                'harga'           => 195000,
                'stok'            => 4,
                'deskripsi'       => 'Administrasi dan optimasi PostgreSQL',
                'bahasa'          => 'Inggris',
            ],
            [
                'kode_buku'       => 'BK-008',
                'judul'           => 'React & Next.js Development',
                'kategori'        => 'Programming',
                'pengarang'       => 'Sarah Anderson',
                'penerbit'        => 'Frontend Press',
                'negara_penerbit' => 'Amerika Serikat',
                'kota_penerbit'   => 'Austin',
                'tahun_terbit'    => 2024,
                'isbn'            => '978-602-1234-56-8',
                'harga'           => 165000,
                'stok'            => 22,
                'deskripsi'       => 'Membangun aplikasi modern dengan React dan Next.js',
                'bahasa'          => 'Inggris',
            ],
        ];

        foreach ($bukuList as $buku) {
            Buku::create($buku);
        }
    }
}

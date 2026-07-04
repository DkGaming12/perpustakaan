<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;

class AnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengisi data anggota sample untuk sistem perpustakaan.
     */
    public function run(): void
    {
        $anggotaList = [
            // 1
            [
                'kode_anggota'   => 'AGT-001',
                'nama'           => 'Budi Santoso',
                'email'          => 'budi.santoso@email.com',
                'telepon'        => '081234567890',
                'alamat'         => 'Jl. Merdeka No. 10, Jakarta Pusat',
                'tanggal_lahir'  => '1995-05-15',
                'jenis_kelamin'  => 'Laki-laki',
                'pekerjaan'      => 'Mahasiswa',
                'tanggal_daftar' => '2024-01-10',
                'status'         => 'Aktif',
            ],
            // 2
            [
                'kode_anggota'   => 'AGT-002',
                'nama'           => 'Siti Nurhaliza',
                'email'          => 'siti.nur@email.com',
                'telepon'        => '081234567891',
                'alamat'         => 'Jl. Sudirman No. 25, Bandung',
                'tanggal_lahir'  => '1998-08-20',
                'jenis_kelamin'  => 'Perempuan',
                'pekerjaan'      => 'Pegawai Swasta',
                'tanggal_daftar' => '2024-01-15',
                'status'         => 'Aktif',
            ],
            // 3
            [
                'kode_anggota'   => 'AGT-003',
                'nama'           => 'Ahmad Dhani',
                'email'          => 'ahmad.dhani@email.com',
                'telepon'        => '081234567892',
                'alamat'         => 'Jl. Gatot Subroto No. 5, Surabaya',
                'tanggal_lahir'  => '1992-03-10',
                'jenis_kelamin'  => 'Laki-laki',
                'pekerjaan'      => 'Dosen',
                'tanggal_daftar' => '2024-02-01',
                'status'         => 'Aktif',
            ],
            // 4
            [
                'kode_anggota'   => 'AGT-004',
                'nama'           => 'Dewi Lestari',
                'email'          => 'dewi.lestari@email.com',
                'telepon'        => '081234567893',
                'alamat'         => 'Jl. Ahmad Yani No. 30, Yogyakarta',
                'tanggal_lahir'  => '2000-12-05',
                'jenis_kelamin'  => 'Perempuan',
                'pekerjaan'      => 'Mahasiswa',
                'tanggal_daftar' => '2024-02-10',
                'status'         => 'Aktif',
            ],
            // 5
            [
                'kode_anggota'   => 'AGT-005',
                'nama'           => 'Rizky Febian',
                'email'          => 'rizky.feb@email.com',
                'telepon'        => '081234567894',
                'alamat'         => 'Jl. Diponegoro No. 15, Semarang',
                'tanggal_lahir'  => '1997-07-18',
                'jenis_kelamin'  => 'Laki-laki',
                'pekerjaan'      => 'Wiraswasta',
                'tanggal_daftar' => '2023-12-15',
                'status'         => 'Nonaktif',
            ],
            // 6
            [
                'kode_anggota'   => 'AGT-006',
                'nama'           => 'Isyana Sarasvati',
                'email'          => 'isyana.s@email.com',
                'telepon'        => '081234567895',
                'alamat'         => 'Jl. Pahlawan No. 8, Medan',
                'tanggal_lahir'  => '1993-05-02',
                'jenis_kelamin'  => 'Perempuan',
                'pekerjaan'      => 'Musisi',
                'tanggal_daftar' => '2024-03-11',
                'status'         => 'Aktif',
            ],
            // 7
            [
                'kode_anggota'   => 'AGT-007',
                'nama'           => 'Iwan Fals',
                'email'          => 'iwan.fals@email.com',
                'telepon'        => '081234567896',
                'alamat'         => 'Jl. Kebangsaan No. 99, Jakarta Timur',
                'tanggal_lahir'  => '1961-09-03',
                'jenis_kelamin'  => 'Laki-laki',
                'pekerjaan'      => 'Pensiunan',
                'tanggal_daftar' => '2024-03-20',
                'status'         => 'Aktif',
            ],
            // 8
            [
                'kode_anggota'   => 'AGT-008',
                'nama'           => 'Raisa Andriana',
                'email'          => 'raisa.a@email.com',
                'telepon'        => '081234567897',
                'alamat'         => 'Jl. Bunga Raya No. 12, Bali',
                'tanggal_lahir'  => '1990-06-06',
                'jenis_kelamin'  => 'Perempuan',
                'pekerjaan'      => 'Penyanyi',
                'tanggal_daftar' => '2024-04-05',
                'status'         => 'Aktif',
            ],
            // 9
            [
                'kode_anggota'   => 'AGT-009',
                'nama'           => 'Nicholas Saputra',
                'email'          => 'nicholas.s@email.com',
                'telepon'        => '081234567898',
                'alamat'         => 'Jl. Cendrawasih No. 4, Makassar',
                'tanggal_lahir'  => '1984-02-24',
                'jenis_kelamin'  => 'Laki-laki',
                'pekerjaan'      => 'Aktor',
                'tanggal_daftar' => '2024-04-10',
                'status'         => 'Nonaktif',
            ],
            // 10
            [
                'kode_anggota'   => 'AGT-010',
                'nama'           => 'Maudy Ayunda',
                'email'          => 'maudy.a@email.com',
                'telepon'        => '081234567899',
                'alamat'         => 'Jl. Pelajar No. 1, Jakarta Selatan',
                'tanggal_lahir'  => '1994-12-19',
                'jenis_kelamin'  => 'Perempuan',
                'pekerjaan'      => 'Dosen',
                'tanggal_daftar' => '2024-04-12',
                'status'         => 'Aktif',
            ],
            // 11
            [
                'kode_anggota'   => 'AGT-011',
                'nama'           => 'Reza Rahadian',
                'email'          => 'reza.r@email.com',
                'telepon'        => '081234567800',
                'alamat'         => 'Jl. Kesenian No. 21, Bogor',
                'tanggal_lahir'  => '1987-03-05',
                'jenis_kelamin'  => 'Laki-laki',
                'pekerjaan'      => 'Aktor',
                'tanggal_daftar' => '2024-04-15',
                'status'         => 'Aktif',
            ],
            // 12
            [
                'kode_anggota'   => 'AGT-012',
                'nama'           => 'Dian Sastrowardoyo',
                'email'          => 'dian.s@email.com',
                'telepon'        => '081234567801',
                'alamat'         => 'Jl. Melati No. 45, Malang',
                'tanggal_lahir'  => '1982-03-16',
                'jenis_kelamin'  => 'Perempuan',
                'pekerjaan'      => 'Pegawai Swasta',
                'tanggal_daftar' => '2024-04-18',
                'status'         => 'Aktif',
            ],
            // 13
            [
                'kode_anggota'   => 'AGT-013',
                'nama'           => 'Vidi Aldiano',
                'email'          => 'vidi.a@email.com',
                'telepon'        => '081234567802',
                'alamat'         => 'Jl. Kutilang No. 7, Jakarta Barat',
                'tanggal_lahir'  => '1990-03-29',
                'jenis_kelamin'  => 'Laki-laki',
                'pekerjaan'      => 'Penyiar Radio',
                'tanggal_daftar' => '2024-05-02',
                'status'         => 'Aktif',
            ],
            // 14
            [
                'kode_anggota'   => 'AGT-014',
                'nama'           => 'Afgansyah Reza',
                'email'          => 'afgan.r@email.com',
                'telepon'        => '081234567803',
                'alamat'         => 'Jl. Kenari No. 11, Depok',
                'tanggal_lahir'  => '1989-05-27',
                'jenis_kelamin'  => 'Laki-laki',
                'pekerjaan'      => 'Wiraswasta',
                'tanggal_daftar' => '2024-05-08',
                'status'         => 'Aktif',
            ],
            // 15
            [
                'kode_anggota'   => 'AGT-015',
                'nama'           => 'Najwa Shihab',
                'email'          => 'najwa.s@email.com',
                'telepon'        => '081234567804',
                'alamat'         => 'Jl. Jurnalis No. 1, Jakarta Utara',
                'tanggal_lahir'  => '1977-09-16',
                'jenis_kelamin'  => 'Perempuan',
                'pekerjaan'      => 'Jurnalis',
                'tanggal_daftar' => '2024-05-10',
                'status'         => 'Aktif',
            ],
            // 16
            [
                'kode_anggota'   => 'AGT-016',
                'nama'           => 'Raditya Dika',
                'email'          => 'raditya.d@email.com',
                'telepon'        => '081234567805',
                'alamat'         => 'Jl. Komedi No. 10, Tangerang',
                'tanggal_lahir'  => '1984-12-28',
                'jenis_kelamin'  => 'Laki-laki',
                'pekerjaan'      => 'Penulis',
                'tanggal_daftar' => '2024-05-15',
                'status'         => 'Aktif',
            ],
            // 17
            [
                'kode_anggota'   => 'AGT-017',
                'nama'           => 'Jerome Polin',
                'email'          => 'jerome.p@email.com',
                'telepon'        => '081234567806',
                'alamat'         => 'Jl. Matematika No. 100, Surabaya',
                'tanggal_lahir'  => '1998-05-02',
                'jenis_kelamin'  => 'Laki-laki',
                'pekerjaan'      => 'Mahasiswa',
                'tanggal_daftar' => '2024-05-20',
                'status'         => 'Aktif',
            ],
        ];

        foreach ($anggotaList as $anggota) {
            Anggota::firstOrCreate(['kode_anggota' => $anggota['kode_anggota']], $anggota);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * Urutan penting: Kategori dulu sebelum Buku.
     */
    public function run(): void
    {
        // Create Admin User
        \App\Models\User::factory()->create([
            'name' => 'Admin Perpustakaan',
            'email' => 'didikadmin@perpustakaan.com',
            'password' => bcrypt('60324067'),
        ]);

        // Run other seeders
        $this->call([
            KategoriSeeder::class,
            BukuSeeder::class,
            AnggotaSeeder::class,
        ]);
    }
}

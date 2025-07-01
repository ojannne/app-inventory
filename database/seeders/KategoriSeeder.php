<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminId = \App\Models\User::where('email', 'admin@pesantren.com')->value('id') ?? 1;
        $data = [
            [
                'nama_kategori' => 'Aset Bangunan',
                'deskripsi' => 'Bangunan seperti masjid, asrama, kelas, dapur, dll',
                'kode_kategori' => 'KAT-BANGUNAN',
                'status' => 'aktif',
                'created_by' => $adminId,
            ],
            [
                'nama_kategori' => 'Peralatan',
                'deskripsi' => 'Peralatan dan perlengkapan pesantren',
                'kode_kategori' => 'KAT-PERALATAN',
                'status' => 'aktif',
                'created_by' => $adminId,
            ],
            [
                'nama_kategori' => 'Buku & Kitab',
                'deskripsi' => 'Buku dan kitab perpustakaan',
                'kode_kategori' => 'KAT-BUKU',
                'status' => 'aktif',
                'created_by' => $adminId,
            ],
            [
                'nama_kategori' => 'Kendaraan',
                'deskripsi' => 'Kendaraan operasional pesantren',
                'kode_kategori' => 'KAT-KENDARAAN',
                'status' => 'aktif',
                'created_by' => $adminId,
            ],
            [
                'nama_kategori' => 'Elektronik',
                'deskripsi' => 'Barang elektronik seperti komputer, printer, dll',
                'kode_kategori' => 'KAT-ELEKTRONIK',
                'status' => 'aktif',
                'created_by' => $adminId,
            ],
            [
                'nama_kategori' => 'Pakaian & Seragam',
                'deskripsi' => 'Seragam santri, jubah, dll',
                'kode_kategori' => 'KAT-PAKAIAN',
                'status' => 'aktif',
                'created_by' => $adminId,
            ],
        ];

        foreach ($data as $item) {
            Kategori::updateOrCreate([
                'kode_kategori' => $item['kode_kategori']
            ], $item);
        }
    }
}

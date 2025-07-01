<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aset;
use App\Models\Maintenance;
use App\Models\Kategori;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            KategoriSeeder::class,
            PesantrenSeeder::class,
        ]);

        // Pastikan user admin ada
        $admin = User::firstOrCreate([
            'email' => 'admin@pesantren.com'
        ], [
            'name' => 'Administrator',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        $adminId = $admin->id ?? (User::first()->id ?? 1);
        $kategoriId = Kategori::first()->id ?? 1;

        // Seeder demo aset
        $aset = Aset::updateOrCreate([
            'kode_aset' => 'KD001',
        ], [
            'nama_aset' => 'Kanopi',
            'kategori_id' => $kategoriId,
            'deskripsi' => 'tes ada',
            'lokasi' => 'Gedung Utama',
            'tanggal_pembelian' => now(),
            'harga' => 1000000,
            'kondisi' => 'Baik',
            'status' => 'tersedia',
            'user_id' => $adminId,
            'created_by' => $adminId,
        ]);

        // Seeder demo maintenance
        $asetId = $aset->id;
        $userId = $adminId ?? (User::first()->id ?? 1);
        Maintenance::updateOrCreate([
            'aset_id' => $asetId,
            'jenis_maintenance' => 'preventif',
        ], [
            'tanggal_maintenance' => now(),
            'deskripsi' => 'Perawatan rutin kanopi',
            'status' => 'selesai',
            'catatan' => 'Perawatan rutin',
            'user_id' => $userId,
            'created_by' => $userId,
        ]);
    }
}

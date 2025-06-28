<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pesantren;

class PesantrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pesantren::create([
            'nama_pesantren' => 'PeTIK II Jombang',
            'alamat' => 'Jl. Pesantren No. 123, Desa Mekarjaya, Kecamatan Sukamaju, Kabupaten Jombang, Jawa Timur 61481',
            'telepon' => '0321-123456',
            'email' => 'info@petik2jombang.com',
            'website' => 'https://petik2jombang.com',
            'deskripsi' => 'PeTIK II Jombang adalah lembaga pendidikan Islam yang berkomitmen untuk mencetak generasi muslim yang berakhlak mulia, berilmu, dan bermanfaat bagi umat.',
            'visi' => 'Menjadi pesantren unggulan yang menghasilkan santri berakhlak mulia, berwawasan luas, dan siap berkontribusi untuk kemajuan umat dan bangsa.',
            'misi' => '1. Menyelenggarakan pendidikan Islam yang berkualitas\n2. Membentuk karakter santri yang berakhlak mulia\n3. Mengembangkan potensi santri secara optimal\n4. Mempersiapkan santri untuk kehidupan yang mandiri',
            'tahun_berdiri' => 1985,
            'jumlah_santri' => 250,
            'jumlah_ustadz' => 15,
        ]);
    }
}

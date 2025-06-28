<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesantren extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pesantren',
        'alamat',
        'telepon',
        'email',
        'website',
        'deskripsi',
        'visi',
        'misi',
        'logo',
        'tahun_berdiri',
        'jumlah_santri',
        'jumlah_ustadz',
    ];

    protected $casts = [
        'tahun_berdiri' => 'integer',
        'jumlah_santri' => 'integer',
        'jumlah_ustadz' => 'integer',
    ];

    protected $table = 'pesantren';
}

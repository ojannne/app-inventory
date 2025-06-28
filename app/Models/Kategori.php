<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';
    protected $fillable = [
        'nama_kategori',
        'deskripsi',
        'kode_kategori',
        'status'
    ];

    public function asets()
    {
        return $this->hasMany(Aset::class, 'kategori_id');
    }
}

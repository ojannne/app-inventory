<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    use HasFactory;

    protected $table = 'asets';
    protected $fillable = [
        'kode_aset',
        'nama_aset',
        'kategori_id',
        'deskripsi',
        'lokasi',
        'tanggal_pembelian',
        'harga',
        'kondisi',
        'status',
        'gambar',
        'user_id'
    ];

    protected $casts = [
        'tanggal_pembelian' => 'date',
        'harga' => 'decimal:2'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'aset_id');
    }
}

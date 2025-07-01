<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenance';
    protected $fillable = [
        'aset_id',
        'jenis_maintenance',
        'tanggal_maintenance',
        'deskripsi',
        'biaya',
        'teknisi',
        'status',
        'catatan',
        'user_id',
        'created_by'
    ];

    protected $casts = [
        'tanggal_maintenance' => 'date',
        'biaya' => 'decimal:2'
    ];

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

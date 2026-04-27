<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'latihan_id',
        'pemain_id',
        'status_kehadiran',
        'keterangan',
    ];

    public function latihan()
    {
        return $this->belongsTo(Latihan::class);
    }

    public function pemain()
    {
        return $this->belongsTo(Pemain::class);
    }
}
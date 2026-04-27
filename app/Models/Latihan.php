<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelatih_id',
        'tanggal',
        'jam',
        'lokasi',
        'materi_latihan',
    ];

    public function pelatih()
    {
        return $this->belongsTo(Pelatih::class);
    }

    public function presensis()
{
    return $this->hasMany(Presensi::class);
}

public function performas()
{
    return $this->hasMany(Performa::class);
}
}
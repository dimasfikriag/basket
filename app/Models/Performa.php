<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performa extends Model
{
    use HasFactory;

    protected $fillable = [
        'pemain_id',
        'latihan_id',
        'pelatih_id',
        'stamina',
        'speed',
        'shooting',
        'passing',
        'dribbling',
        'defense',
        'catatan',
        'tanggal_penilaian',
    ];

    public function pemain()
    {
        return $this->belongsTo(Pemain::class);
    }

    public function latihan()
    {
        return $this->belongsTo(Latihan::class);
    }

    public function pelatih()
    {
        return $this->belongsTo(Pelatih::class);
    }
}
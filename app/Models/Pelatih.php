<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelatih extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'lisensi',
        'spesialisasi',
        'no_hp',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
public function latihans()
{
    return $this->hasMany(Latihan::class);
}

public function performas()
{
    return $this->hasMany(Performa::class);
}

}
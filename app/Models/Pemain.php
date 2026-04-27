<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemain extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'tanggal_lahir',
        'nomor_punggung',
        'posisi',
        'tinggi_badan',
        'berat_badan',
        'no_hp',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
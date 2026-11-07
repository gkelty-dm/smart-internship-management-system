<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $fillable = [
        'siswa_id',
        'tanggal',

        'jam_masuk',
        'jam_pulang',

        'foto_masuk',
        'foto_pulang',

        'latitude_masuk',
        'longitude_masuk',

        'latitude_pulang',
        'longitude_pulang',

        'metode_verifikasi',

        'device_info',
        'ip_address',

        'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
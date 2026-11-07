<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $fillable = [
        'siswa_id',
        'tanggal',
        'kegiatan',
        'kendala',
        'solusi',
        'status_validasi',
        'catatan_guru'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function fotos()
    {
        return $this->hasMany(LogbookFoto::class);
    }
}

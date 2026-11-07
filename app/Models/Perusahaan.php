<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'perusahaans';

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'latitude',
        'longitude',
        'radius_absensi',
        'telepon',
        'email',
    ];

    /**
     * Pembimbing industri yang bekerja di perusahaan.
     */
    public function industris()
    {
        return $this->hasMany(Industri::class, 'perusahaan_id');
    }
}

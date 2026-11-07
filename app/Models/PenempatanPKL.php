<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenempatanPKL extends Model
{
    protected $table = 'penempatan_pkl';

    protected $fillable = [
        'siswa_id',
        'guru_id',
        'industri_id',
        'perusahaan_id',
        'tanggal_mulai',
        'tanggal_selesai',
        'status_pkl'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function industri()
    {
        return $this->belongsTo(Industri::class);
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function penilaianGuru()
{
    return $this->hasOne(
        PenilaianGuru::class,
        'penempatan_pkl_id'
    );
}

public function nilaiPKL()
{
    return $this->hasOne(
        NilaiPKL::class,
        'penempatan_pkl_id'
    );
}

public function penilaianIndustri()
{
    return $this->hasOne(
        PenilaianIndustri::class,
        'penempatan_pkl_id'
    );
}

}
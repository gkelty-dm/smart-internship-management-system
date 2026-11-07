<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenilaianIndustri extends Model
{
    protected $table = 'penilaian_industri';

    protected $fillable = [
        'penempatan_pkl_id',
        'industri_id',
        'disiplin',
        'kerjasama',
        'inisiatif',
        'tanggung_jawab',
        'keterampilan',
        'nilai_akhir',
        'catatan'
    ];

    public function penempatan()
    {
        return $this->belongsTo(
            PenempatanPKL::class,
            'penempatan_pkl_id'
        );
    }

    public function industri()
    {
        return $this->belongsTo(
            Industri::class
        );
    }
}
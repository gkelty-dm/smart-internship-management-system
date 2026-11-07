<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NilaiPKL extends Model
{
    protected $table = 'nilai_pkl';

    protected $fillable = [

        'penempatan_pkl_id',

        'nilai_industri',

        'nilai_guru',

        'nilai_akhir',

        'predikat'

    ];

    public function penempatan()
    {
        return $this->belongsTo(
            PenempatanPKL::class,
            'penempatan_pkl_id'
        );
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    protected $fillable = [
        'user_id',
        'perusahaan_id',
        'jabatan',
        'no_hp'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }


    public function penempatanPKL()
    {
        return $this->hasMany(
            PenempatanPKL::class,
            'industri_id'
        );
    }
}

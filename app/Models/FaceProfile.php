<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaceProfile extends Model
{
    protected $fillable = [
        'siswa_id',
        'is_registered',
        'face_encoding_path',
        'registered_at',
    ];


    /*
    |--------------------------------------------------------------------------
    | SISWA
    |--------------------------------------------------------------------------
    */

    public function siswa()
    {
        return $this->belongsTo(
            Siswa::class,
            'siswa_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FOTO WAJAH
    |--------------------------------------------------------------------------
    */

    public function images()
    {
        return $this->hasMany(
            FaceImage::class,
            'face_profile_id'
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FaceProfile;

class Siswa extends Model
{
    protected $fillable = [

        'user_id',
        'nisn',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'jurusan_id',
        'kelas_id',
        'foto'

    ];


    /*
    |--------------------------------------------------------------------------
    | USER
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | JURUSAN
    |--------------------------------------------------------------------------
    */

    public function jurusan()
    {
        return $this->belongsTo(
            Jurusan::class,
            'jurusan_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | KELAS
    |--------------------------------------------------------------------------
    */

    public function kelas()
    {
        return $this->belongsTo(
            Kelas::class,
            'kelas_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | LOGBOOK
    |--------------------------------------------------------------------------
    */

    public function logbooks()
    {
        return $this->hasMany(
            Logbook::class,
            'siswa_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | FACE PROFILE
    |--------------------------------------------------------------------------
    */

    public function faceProfile()
    {
        return $this->hasOne(
            FaceProfile::class,
            'siswa_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PENEMPATAN PKL
    |--------------------------------------------------------------------------
    */

    public function penempatanPKL()
    {
        return $this->hasOne(
            PenempatanPKL::class,
            'siswa_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ABSENSI
    |--------------------------------------------------------------------------
    */

    public function absensis()
    {
        return $this->hasMany(
            Absensi::class,
            'siswa_id'
        );
    }
}

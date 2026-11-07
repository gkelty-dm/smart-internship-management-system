<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'jurusan_id',
        'nama_kelas'
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}
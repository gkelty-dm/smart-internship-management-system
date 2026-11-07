<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'alamat',
        'no_hp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function penempatanPKL()
    {
        return $this->hasMany(
            PenempatanPKL::class,
            'guru_id'
        );
    }
}

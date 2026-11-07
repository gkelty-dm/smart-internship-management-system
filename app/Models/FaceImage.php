<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaceImage extends Model
{
    protected $fillable = [
        'face_profile_id',
        'file_path'
    ];

    public function profile()
    {
        return $this->belongsTo(
            FaceProfile::class,
            'face_profile_id'
        );
    }
}
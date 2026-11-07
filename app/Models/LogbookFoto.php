<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogbookFoto extends Model
{
    protected $table = 'logbook_fotos';

    protected $fillable = [
        'logbook_id',
        'foto',
    ];

    public function logbook()
    {
        return $this->belongsTo(
            Logbook::class,
            'logbook_id'
        );
    }
}

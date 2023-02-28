<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnAudio extends Audio
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'en_audio';

    protected $fillable = [
        'word',
        'path',
    ];
}

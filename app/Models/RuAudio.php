<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuAudio extends Audio
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'word',
        'path',
    ];

    protected $table = 'ru_audio';

}

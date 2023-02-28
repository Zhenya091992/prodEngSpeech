<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OxfordWord extends Model
{
    use HasFactory;

    protected $fillable = [
        'word',
        'link',
        'part',
        'level',
        'us_mp3_href',
        'us_ogg_href',
        'br_mp3_href',
        'br_ogg_href',
    ];

    public $timestamps = false;
}

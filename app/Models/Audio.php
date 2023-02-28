<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class Audio extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_enWord',
        'path',
    ];

    public $timestamps = true;

    public function enWord()
    {
        return $this->hasMany(EnWord::class, 'id_audio', 'id');
    }
}

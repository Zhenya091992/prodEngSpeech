<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnWord extends Word
{
    use HasFactory;

    protected $table = 'en_words';

    protected $fillable = [
        'word',
        'transcription',
        'count_repeated',
        'id_status',
        'id_audio',
    ];

    public function ruWords()
    {
        return $this->belongsToMany(
            RuWord::class,
            $this->relationsEnRuTable,
            'en_word_id',
            'ru_word_id'
        );
    }

    public function audio()
    {
        return $this->hasOne(EnAudio::class, 'id', 'id_audio');
    }
}

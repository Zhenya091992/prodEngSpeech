<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class RuWord extends Word
{
    use HasFactory;

    protected $fillable = [
        'word',
        'count_repeated',
        'id_status',
        'id_audio',
    ];

    /**
     * @return BelongsToMany
     */
    public function enWords(): BelongsToMany
    {
        return $this->belongsToMany(
            EnWord::class,
            $this->relationsEnRuTable,
            'ru_word_id',
            'en_word_id'
        );
    }

    public function audio()
    {
        return $this->hasOne(RuAudio::class, 'id', 'id_audio');
    }
}

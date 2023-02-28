<?php

namespace App\Models;

use App\Jobs\DownloadAudio;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yayheni\Speechgen\SpeechgenAPI;

abstract class Word extends Model
{
    protected $relationsEnRuTable = 'en-ru_relations';

    abstract public function audio();

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'id_status');
    }
}

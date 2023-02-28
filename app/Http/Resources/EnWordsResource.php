<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class EnWordsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'word' => $this->word,
            'translate' => new RuWordsCollection($this->ruWords),
            'transcription' => $this->transcription,
            'audio' => Str::replace('public/', 'storage/', $this->audio->path),
        ];
    }
}

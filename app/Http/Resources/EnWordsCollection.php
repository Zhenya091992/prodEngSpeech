<?php

namespace App\Http\Resources;

use App\Models\Audio;
use App\Models\EnWord;
use App\Models\RuWord;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EnWordsCollection extends ResourceCollection
{
    public $collects = EnWordsResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->collection;
    }
}

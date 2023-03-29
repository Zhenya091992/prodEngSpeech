<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnWordsCollection;
use App\Http\Resources\EnWordsResource;
use App\Models\EnWord;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class APIListen extends Controller
{
    public function listen()
    {
        $words = EnWord::join('user-en_word_relations', 'en_words.id', '=', 'user-en_word_relations.en_word_id')
            ->where('user_id', '=', Auth::user()->id)
            ->where('status_id', '=', Status::LEARN)
            ->get();

        return (new EnWordsCollection($words));
    }
}

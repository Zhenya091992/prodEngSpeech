<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnWordsCollection;
use App\Models\EnWord;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIListen extends Controller
{
    public function listen(Request $request)
    {
        $words = EnWord::join('user-en_word_relations', 'en_words.id', '=', 'user-en_word_relations.en_word_id')
            ->where('user_id', '=', Auth::user()->id)
            ->where('status_id', '=', Status::LEARN)
            ->get()
            ->keyBy
            ->id;

        return response()->json((new EnWordsCollection($words))->toArray($request)->toArray());
    }
}

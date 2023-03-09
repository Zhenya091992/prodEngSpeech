<?php

namespace App\Http\Controllers;

use App\Models\EnWord;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllEnWordsForLearnController extends Controller
{
    public function wordsForLearning()
    {
        $words = EnWord::leftJoin('user-en_word_relations', function ($join) {
            $join->on('en_words.id', '=', 'user-en_word_relations.en_word_id')
            ->where('user_id', '=', Auth::user()->getAuthIdentifier());
        })->where('user_id', '=', null)->paginate(50);

        return view('Cabinet.EnWordsForLearn.index', ['enWords' => $words]);
    }
    public function learn()
    {
        $words = EnWord::join('user-en_word_relations', 'en_words.id', '=', 'user-en_word_relations.en_word_id')
            ->where('user_id', '=', Auth::user()->id)
            ->where('status_id', '=', Status::LEARN)
            ->paginate(50);

        return view('Cabinet.EnWordsForLearn.learn', ['enWords' => $words]);
    }

    public function listen()
    {
        return view('Cabinet.listen');
    }

    public function learned()
    {
        $words = EnWord::join('user-en_word_relations', 'en_words.id', '=', 'user-en_word_relations.en_word_id')
            ->where('user_id', '=', Auth::user()->id)
            ->where('status_id', '=', Status::LEARNED)
            ->paginate(50);

        return view('Cabinet.EnWordsForLearn.learned', ['enWords' => $words]);
    }
}

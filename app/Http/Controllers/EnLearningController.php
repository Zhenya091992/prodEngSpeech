<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnWordsResource;
use App\Models\EnWord;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;

class EnLearningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $word = EnWord::join('user-en_word_relations', 'en_words.id', '=', 'user-en_word_relations.en_word_id')
            ->where('user_id', '=', Auth::user()->id)
            ->where('status_id', '=', Status::LEARN)
            ->inRandomOrder()
            ->first();

        return (new EnWordsResource($word))->toJson(256);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
}

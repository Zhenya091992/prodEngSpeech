<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnWordsCollection;
use App\Http\Resources\EnWordsResource;
use App\Models\EnWord;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllEnWordsForLearnController extends Controller
{
    public function table()
    {
        $wordsForLearn = Auth::user()->enWords;

        return view('Cabinet.EnWordsForLearn.index', ['enWords' => $wordsForLearn]);
    }

    public function listen()
    {
        return view('Cabinet.listen');
    }
}

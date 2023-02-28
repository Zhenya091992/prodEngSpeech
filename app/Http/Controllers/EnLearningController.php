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
        $enWord = Auth::user()->enWords->random();
        //dd((new EnWordsResource($enWord))->toJson(256));
        return (new EnWordsResource($enWord))->toJson(256);
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

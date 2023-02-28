<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnWordsCollection;
use App\Models\EnAudio;
use App\Models\EnWord;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    public function listen()
    {
        return (new EnWordsCollection(EnWord::paginate(1)))->toJson(256);
    }
}

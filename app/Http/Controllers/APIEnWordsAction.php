<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnWordsCollection;
use App\Models\Status;
use App\Services\UserEnRelations;
use App\Services\UserEnWordRelationsQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIEnWordsAction extends Controller
{
    public function addRandWords(Request $request)
    {
        $words = (new UserEnWordRelationsQuery(Auth::id()))
            ->getAllUserWordsNoHaweStatus()
            ->inRandomOrder()
            ->limit(10)
            ->get()
            ->keyBy
            ->id;

        $status = new Status();
        $status->id = Status::LEARN;

        foreach ($words as $enWord) {
            (new UserEnRelations(Auth::user(), $enWord, $status))->save();
        }

        return response()->json((new EnWordsCollection($words))->toArray($request)->toArray());
    }
}

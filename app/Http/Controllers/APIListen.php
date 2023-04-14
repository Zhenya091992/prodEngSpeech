<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnWordsCollection;
use App\Models\EnWord;
use App\Models\Status;
use App\Services\UserEnWordRelationsQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class APIListen extends Controller
{
    public function listen(Request $request)
    {
        $words = (new UserEnWordRelationsQuery(Auth::id()))
            ->getWordsWithStatus(Status::LEARN)
            ->get()
            ->keyBy
            ->id;

        return response()->json((new EnWordsCollection($words))->toArray($request)->toArray());
    }
}

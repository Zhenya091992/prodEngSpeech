<?php

namespace App\Http\Controllers;

use App\Http\Requests\APIEnWordsActionRequest;
use App\Http\Requests\APIEnWordsRequest;
use App\Http\Resources\TableEnWordsCollection;
use App\Models\EnWord;
use App\Models\Status;
use App\Services\UserEnRelations;
use App\Services\UserEnWordRelationsQuery;
use Illuminate\Support\Facades\Auth;

class APIEnWords extends Controller
{
    public function all(APIEnWordsRequest $request)
    {
        $words = (new UserEnWordRelationsQuery(Auth::id()))
            ->getAllUserWordsNoHaweStatus()
            ->orderBy($request->order, $request->sort)
            ->paginate($request->limit);

        return (new TableEnWordsCollection($words));
    }

    public function learn(APIEnWordsRequest $request)
    {
        $words = (new UserEnWordRelationsQuery(Auth::id()))
            ->getWordsWithStatus(Status::LEARN)
            ->orderBy($request->order, $request->sort)
            ->paginate($request->limit);

        return (new TableEnWordsCollection($words));
    }

    public function learned(APIEnWordsRequest $request)
    {
        $words = (new UserEnWordRelationsQuery(Auth::id()))
            ->getWordsWithStatus(Status::LEARNED)
            ->orderBy($request->order, $request->sort)
            ->paginate($request->limit);

        return (new TableEnWordsCollection($words));
    }

    public function action(APIEnWordsActionRequest $request)
    {
        $status = Status::where('name', '=', $request->get('action'))->first();
        if (empty($status)) {
            return response()->json()->setStatusCode(400);
        }

        $service = new UserEnRelations(
            Auth::user(),
            EnWord::findOrFail($request->idWord),
            $status
        );

        if($service->save()) {
            return response()->json([
                'idWord' => $request->idWord,
                'status' => $request->action
                ]);
        }

        return response()->json()->setStatusCode(500);
    }
}

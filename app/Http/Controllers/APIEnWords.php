<?php

namespace App\Http\Controllers;

use App\Http\Requests\APIEnWordsActionRequest;
use App\Http\Requests\APIEnWordsRequest;
use App\Http\Resources\TableEnWordsCollection;
use App\Models\EnWord;
use App\Models\Status;
use App\Services\EnRuRelations;
use Illuminate\Support\Facades\Auth;

class APIEnWords extends Controller
{
    public function all(APIEnWordsRequest $request)
    {
        $words = EnWord::leftJoin('user-en_word_relations', function ($join) {
            $join->on('en_words.id', '=', 'user-en_word_relations.en_word_id')
                ->where('user_id', '=', Auth::user()->getAuthIdentifier());
        })->where('user_id', '=', null)
            ->orderBy($request->order, $request->sort)
            ->paginate($request->limit);

        return (new TableEnWordsCollection($words));
    }

    public function learn(APIEnWordsRequest $request)
    {
        $words = EnWord::join('user-en_word_relations', 'en_words.id', '=', 'user-en_word_relations.en_word_id')
            ->where('user_id', '=', Auth::user()->id)
            ->where('status_id', '=', Status::LEARN)
            ->orderBy($request->order, $request->sort)
            ->paginate($request->limit);

        return (new TableEnWordsCollection($words));
    }

    public function learned(APIEnWordsRequest $request)
    {
        $words = EnWord::join('user-en_word_relations', 'en_words.id', '=', 'user-en_word_relations.en_word_id')
            ->where('user_id', '=', Auth::user()->id)
            ->where('status_id', '=', Status::LEARNED)
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

        $service = new EnRuRelations(
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

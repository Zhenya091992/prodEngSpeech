<?php

namespace App\Http\Controllers;

use App\Models\EnWord;
use App\Models\Status;
use App\Services\EnRuRelations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnWordsForLearnController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $status = Status::where('name', '=', $request->get('status'))->first();
        if (empty($status)) {
            return json_encode(["err" => "undefined status"]);
        }

        $service = new EnRuRelations(
            Auth::user(),
            EnWord::findOrFail($id),
            $status
        );

        $service->save();

        return json_encode(["success" => "undefined status"]);

    }

    public function destroy($id)
    {
        //
    }
}

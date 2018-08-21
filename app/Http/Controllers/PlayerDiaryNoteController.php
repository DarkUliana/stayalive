<?php

namespace App\Http\Controllers;

use App\PlayerDiaryNote;
use Illuminate\Http\Request;

class PlayerDiaryNoteController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->playerID)) {

            return response('Invalid data', 400);
        }

        $response['playerID'] = $request->playerID;
        $response['diaryNotes'] = PlayerDiaryNote::where('googleID', $request->playerID)->get();

        return response($response, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->playerID) || !isset($request->diaryNotes)) {

            return response('Invalid data', 400);
        }

        PlayerDiaryNote::where('googleID', $request->playerID)->delete();

        $counter = 0;
        foreach ($request->diaryNotes as $note) {

            $temp = $note;
            $temp['googleID'] = $request->playerID;
            PlayerDiaryNote::create($temp);

            ++$counter;
        }

        return response("$counter notes was written", 200);
    }
}

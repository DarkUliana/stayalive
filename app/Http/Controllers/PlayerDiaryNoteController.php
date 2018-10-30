<?php

namespace App\Http\Controllers;

use App\PlayerDiaryNote;
use Illuminate\Http\Request;

class PlayerDiaryNoteController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $response['localID'] = $request->localID;
        $response['diaryNotes'] = PlayerDiaryNote::where('playerID', $playerID)->get();

        return response($response, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->localID) || !isset($request->diaryNotes)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        PlayerDiaryNote::where('playerID', $playerID)->delete();

        $counter = 0;
        foreach ($request->diaryNotes as $note) {

            $temp = $note;
            $temp['playerID'] = $playerID;
            PlayerDiaryNote::create($temp);

            ++$counter;
        }

        return response("$counter notes was written", 200);
    }
}

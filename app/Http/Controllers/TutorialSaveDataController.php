<?php

namespace App\Http\Controllers;

use App\TutorialSaveData;
use Illuminate\Http\Request;

class TutorialSaveDataController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        $data = TutorialSaveData::where('playerID', $playerID)->first()->toArray();
        unset($data['playerID']);
        $data['localID'] = $request->localID;

        return response($data, 200);

    }

    public function post(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        TutorialSaveData::where('playerID', $playerID)->delete();

        $data = $request->input();
        unset($data['localID']);

        $data['playerID'] = $playerID;

        TutorialSaveData::create($data);

        return response('ok', 200);
    }
}

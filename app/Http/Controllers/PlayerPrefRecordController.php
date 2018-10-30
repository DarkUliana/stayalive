<?php

namespace App\Http\Controllers;

use App\PlayerPrefRecord;
use Illuminate\Http\Request;

class PlayerPrefRecordController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $records = PlayerPrefRecord::where('playerID', $playerID)->get();

        $data['localID'] = $request->localID;
        $data['prefRecords'] = [];
        foreach ($records as $record) {

            $data['prefRecords'][] = $record->toArray();
        }

        return response($data, 200);
    }

    public function post(Request $request)
    {

        if (!isset($request->localID) || !isset($request->prefRecords)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        PlayerPrefRecord::where('playerID', $playerID)->delete();

        foreach ($request->prefRecords as $record) {

            PlayerPrefRecord::create(array_merge($record, ['playerID' => $playerID]));
        }

        return response('ok', 200);
    }
}

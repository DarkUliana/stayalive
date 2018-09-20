<?php

namespace App\Http\Controllers;

use App\PlayerPrefRecord;
use Illuminate\Http\Request;

class PlayerPrefRecordController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->playerID)) {

            return response('Invalid data', 400);
        }
        $records = PlayerPrefRecord::where('playerID', $request->playerID)->get();

        $data['playerID'] = $request->playerID;
        $data['prefRecords'] = [];
        foreach ($records as $record) {

            $data['prefRecords'][] = $record->toArray();
        }

        return response($data, 200);
    }

    public function post(Request $request)
    {

        if (!isset($request->playerID) || !isset($request->prefRecords)) {

            return response('Invalid data', 400);
        }

        PlayerPrefRecord::where('playerID', $request->playerID)->delete();

        foreach ($request->prefRecords as $record) {

            PlayerPrefRecord::create(array_merge($record, ['playerID' => $request->playerID]));
        }

        return response('ok', 200);
    }
}

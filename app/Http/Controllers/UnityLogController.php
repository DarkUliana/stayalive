<?php

namespace App\Http\Controllers;

use App\UnityLog;
use Illuminate\Http\Request;

class UnityLogController extends Controller
{
    public function index(Request $request) {

        if (!isset($request->localID)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $logs = UnityLog::where('playerID', $playerID)->take(50)->get()->toArray();
        $response = [
            'localID' => $request->localID,
            'logStrings' => $logs
        ];

        return response($response, 200);
    }

    public function store(Request $request) {

        if (!isset($request->localID) || !isset($request->logStrings)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        foreach ($request->logStrings as $log) {

            UnityLog::create(array_merge(['playerID' => $playerID], $log));
        }

        return response('ok', 200);
    }
}

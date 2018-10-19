<?php

namespace App\Http\Controllers;

use App\UnityLog;
use Illuminate\Http\Request;

class UnityLogController extends Controller
{
    public function index(Request $request) {

        if (!isset($request->googleID)) {

            return response('Invalid data', 400);
        }

        $logs = UnityLog::where('googleID', $request->googleID)->take(50)->get()->toArray();
        $response = [
            'playerID' => $request->googleID,
            'logStrings' => $logs
        ];

        return response($response, 200);
    }

    public function store(Request $request) {

        if (!isset($request->playerID) || !isset($request->logStrings)) {

            return response('Invalid data', 400);
        }

        foreach ($request->logStrings as $log) {

            UnityLog::create(array_merge(['googleID' => $request->playerID], $log));
        }

        return response('ok', 200);
    }
}

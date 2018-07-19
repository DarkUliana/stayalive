<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request) {

        if (!isset($request->googleID)) {

            return response('Invalid data', 400);
        }

        $logs = Log::where('googleID', $request->googleID)->get()->toArray();
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

            Log::create(array_merge(['googleID' => $request->playerID], $log));
        }

        return response('ok', 200);
    }
}

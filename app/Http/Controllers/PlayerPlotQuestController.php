<?php

namespace App\Http\Controllers;

use App\PlayerQuest;
use Illuminate\Http\Request;


class PlayerPlotQuestController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->googleID)) {
            return response('Invalid data', 400);
        }

        $quest = PlayerQuest::where('googleID', $request->googleID)->where('type', 'plot')->first();

        if(!$quest) {
            return response('Not Found', 404);
        }

        $response = $quest->toArray();
        $response['questControllerData'] = json_encode(['progress' => $response['progress']]);
        unset($response['progress']);

        return response($response, 200);
    }

    public function store(Request $request)
    {

        if (!isset($request->googleID)) {
            return response('Invalid data', 400);
        }

        $quest = $request->input();
        $quest['progress'] = json_decode($quest['questControllerData'])->progress;
        $quest['type'] = 'plot';
        unset($quest['questControllerData']);

        PlayerQuest::updateOrCreate(['googleID' => $quest['googleID'], 'type' => 'plot'], $quest);

        return response('ok', 200);
    }
}

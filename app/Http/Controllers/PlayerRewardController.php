<?php

namespace App\Http\Controllers;

use App\PlayerReward;
use Illuminate\Http\Request;

class PlayerRewardController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $rewards = PlayerReward::where('playerID', $playerID)->get()->toArray();

        return response(['allChestDatas' => $rewards], 200);
    }

    public function store(Request $request)
    {

        if (!isset($request->localID)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        PlayerReward::where('playerID', $playerID)->delete();

        foreach ($request->allChestDatas as $reward) {

            PlayerReward::create(array_merge(['playerID' => $playerID], $reward));
        }

        return response('ok', 200);
    }
}

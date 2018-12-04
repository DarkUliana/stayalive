<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlayerSceneChest;

class PlayerSceneChestController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $chests['localID'] = $request->localID;
        $chests['sceneChestSaves'] = PlayerSceneChest::where('playerID', $playerID)->get();

        return response($chests, 200);
    }

    public function post(Request $request) {

        if (!isset($request->localID) || !isset($request->sceneChestSaves)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        PlayerSceneChest::where('playerID', $playerID)->delete();

        foreach ($request->sceneChestSaves as $chest) {

            PlayerSceneChest::create(array_merge(['playerID' => $playerID], $chest));
        }

        return response('ok', 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\PlayerEnemySave;
use Illuminate\Http\Request;

class PlayerEnemySaveController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        $enemySaves = PlayerEnemySave::where('playerID', $playerID)->get();

        $returnData = [
            'localID' => $request->localID,
            'enemySaves' => $enemySaves
        ];

        return response($returnData, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->localID) || !isset($request->enemySaves)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        PlayerEnemySave::where('playerID', $playerID)->delete();

        foreach ($request->enemySaves as $enemySave) {

            $insertData = [
                'playerID' => $playerID,
                'enemyName' => $enemySave['enemyName']
            ];

            PlayerEnemySave::create($insertData);
        }

        return response('ok', 200);
    }
}

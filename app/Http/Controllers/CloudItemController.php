<?php

namespace App\Http\Controllers;

use App\CloudItem;
use Illuminate\Http\Request;

class CloudItemController extends Controller
{
    public function getItems(Request $request)
    {
        if (!isset($request->localID)) {
            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $items = [
            'localID' => $request->localID,
            'cloudItems' => CloudItem::where('playerID', $playerID)->where('isTaken', 0)->get()->toArray()
        ];
        return $items;
    }

    public function postItems(Request $request)
    {

        if (!isset($request->localID) || !isset($request->cloudItems)) {
            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        foreach ($request->cloudItems as $item) {

            CloudItem::updateOrCreate(['playerID' => $playerID, 'uniqueID' => $item['uniqueID']], $item);
        }

        return response('ok', 200);
    }
}

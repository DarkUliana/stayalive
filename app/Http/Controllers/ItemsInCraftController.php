<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemInCraftCollection;
use Illuminate\Http\Request;
use App\ItemsInCraft;

class ItemsInCraftController extends Controller
{
    public function show(Request $request)
    {
        if (!isset($request->localID)) {
            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $workbenches['workbenches'] = new ItemInCraftCollection(ItemsInCraft::where('playerID', $playerID)->get());
        $workbenches['localID'] = $request->localID;

        return response($workbenches, 200);
    }

    public function store(Request $request)
    {
        if (!isset($request->workbenches) || !isset($request->localID)) {
            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        ItemsInCraft::where('playerID', $playerID)->delete();

        foreach ($request->workbenches as $item) {

            $data = array_merge($item, $item['itemInCraft']);
            unset($data['itemInCraft']);
            $data['playerID'] = $playerID;
            ItemsInCraft::create($data);
        }
        return response('ok', 201);
    }
}

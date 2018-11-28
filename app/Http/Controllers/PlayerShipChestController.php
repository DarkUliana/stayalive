<?php

namespace App\Http\Controllers;

use App\Http\Resources\SlotCollection;
use App\PlayerShipChest;
use App\PlayerShipChestItem;
use Illuminate\Http\Request;

class PlayerShipChestController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        $chests = PlayerShipChest::where('playerID', $playerID)->get();

        $array['localID'] = $request->localID;
        $array['chestSaves'] = [];

        foreach ($chests as $chest) {

            $array['chestSaves'][] = array_merge($chest->toArray(), ['chestData' => json_encode(new SlotCollection($chest->items))]);
        }

        return response($array, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->chestSaves) || !isset($request->localID)) {


            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $ids = PlayerShipChest::where('playerID', $playerID)->pluck('ID');

        PlayerShipChestItem::whereIn('playerShipChestID', $ids)->delete();
        PlayerShipChest::where('playerID', $playerID)->delete();


        foreach ($request->chestSaves as $chest) {

            $data = $chest;
            unset($data['chestData']);
            $data['playerID'] = $playerID;

            $newChest = PlayerShipChest::create($data);

            foreach (json_decode($chest['chestData'])->slotsData as $value) {

                $slot = json_decode($value->slotInfo, true);

                $slot['itemID'] = $value->itemID;
                unset($slot['localID']);

                $item = new PlayerShipChestItem($slot);
                $newChest->items()->save($item);
            }

        }

        return response("ok", 200);
    }
}

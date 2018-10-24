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
        if (!isset($request->playerID)) {

            return response('Invalid data!', 400);
        }

        $chests = PlayerShipChest::where('playerID', $request->playerID)->get();

        $array['playerID'] = $request->playerID;
        $array['chestSaves'] = [];

        foreach ($chests as $chest) {

            $array['chestSaves'][] = array_merge($chest->toArray(), ['chestsData' => json_encode(new SlotCollection($chest->items))]);
        }

        return response($array, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->chestSaves) || !isset($request->playerID)) {


            return response('Invalid data', 400);
        }


        $ids = PlayerShipChest::where('playerID', $request->playerID)->pluck('ID');

        PlayerShipChestItem::whereIn('playerShipChestID', $ids)->delete();
        PlayerShipChest::where('playerID', $request->playerID)->delete();


        foreach ($request->chestSaves as $chest) {

            $data = $chest;
            unset($data['chestData']);
            $data['playerID'] = $request->playerID;

            $newChest = PlayerShipChest::create($data);

            dd(json_decode($chest['chestData'])['slotsData']);
            foreach (json_decode($chest['chestData']) as $value) {

                $slot = json_decode($value['slotInfo'], true);

                $slot['itemID'] = $value['itemID'];
                unset($slot['googleID']);

                $item = new PlayerShipChestItem($slot);
                $newChest->items()->save($item);
            }

        }

        return response("ok", 200);
    }
}

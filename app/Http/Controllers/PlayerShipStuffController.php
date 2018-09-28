<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerShipStuffCollection;
use App\PlayerShipStuff;
use App\PlayerShipStuffItem;
use App\PlayerTechnologyQuantity;
use Illuminate\Http\Request;

class PlayerShipStuffController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->playerID)) {

            return response('Invalid data!', 400);
        }

        $data['shipFloors'] = PlayerShipStuff::where('playerID', $request->playerID)->with('items')->get()->toArray();

        $data['concreteItemsCounts'] = PlayerTechnologyQuantity::where('playerID', $request->playerID)->get()->toArray();


        return response($data, 200);

    }

    public function post(Request $request)
    {
        if (!isset($request->playerID)) {

            return response('Invalid data!', 400);
        }


        $ids = PlayerShipStuff::where('playerID', $request->playerID)->pluck('ID')->toArray();
        PlayerShipStuffItem::whereIn('stuffID', $ids)->delete();
        PlayerShipStuff::where('playerID', $request->playerID)->delete();

        foreach ($request->shipFloors as $item) {

            $stuff = $item;
            $stuff['playerID'] = $request->playerID;
            unset($stuff['floorCells']);
            $newItem = PlayerShipStuff::create($stuff);

            foreach ($item['floorCells'] as $cell) {

                $newCell = new PlayerShipStuffItem($cell);
                $newItem->items()->save($newCell);
            }
        }

        PlayerTechnologyQuantity::where('playerID', $request->playerID)->delete();
        foreach ($request->concreteItemsCounts as $item) {

            $data = $item;
            $data['playerID'] = $request->playerID;
            PlayerTechnologyQuantity::create($data);
        }

        return response('ok', 200);
    }
}

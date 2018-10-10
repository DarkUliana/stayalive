<?php

namespace App\Http\Controllers;

//use App\Http\Resources\PlayerShipStuffCollection;
use App\PlayerShipStuff;
use App\PlayerShipStuffItem;
use App\PlayerTechnologyQuantity;
use App\ShipStuff;
use Illuminate\Http\Request;

class PlayerShipStuffController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->playerID)) {

            return response('Invalid data!', 400);
        }

        $floors = ShipStuff::with(['items' => function ($query) use ($request) {
            $query->where('playerID', $request->playerID);
        }])->with('defaultItems')->get();

        $collection = collect();

        foreach ($floors as $floor) {

            $temp = $floor->toArray();

            if ($floor->items->count() != $floor->defaultItems->count()) {

                $indexes = $floor->items->pluck('cellIndex')->toArray();

                $needed = $floor->defaultItems->whereNotIn('cellIndex', $indexes);

                $temp['floorCells'] = collect(array_merge($floor->items->toArray(), $needed->toArray()));

            } else {

                $temp['floorCells'] = $floor->items;
            }

            $max = $temp['floorCells']->count() - $temp['floorCells']->count() % $floor->deckWidth;
            $temp['floorCells'] = $temp['floorCells']->sortBy('cellIndex')->splice(0, $max);

            unset($temp['default_items']);
            unset($temp['items']);
            $collection->push($temp);
        }

        $data['shipFloors'] = $collection;

        $data['concreteItemsCounts'] = PlayerTechnologyQuantity::where('playerID', $request->playerID)->get();


        return response($data, 200);

    }

    public
    function post(Request $request)
    {
        if (!isset($request->playerID)) {

            return response('Invalid data!', 400);
        }

        PlayerShipStuffItem::where('playerID', $request->playerID)->delete();

        foreach ($request->shipFloors as $item) {

            $floor = ShipStuff::where('floorIndex', $item['floorIndex'])->first();

            foreach ($item['floorCells'] as $cell) {

                $temp = $cell;
                $temp['playerID'] = $request->playerID;
                $newCell = new PlayerShipStuffItem($temp);
                $floor->items()->save($newCell);
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

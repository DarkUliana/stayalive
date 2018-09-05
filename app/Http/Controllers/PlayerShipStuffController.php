<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerShipStuffCollection;
use App\PlayerShipStuff;
use Illuminate\Http\Request;

class PlayerShipStuffController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->playerID)) {

            return response('Invalid data!', 400);
        }

        $data = new PlayerShipStuffCollection(PlayerShipStuff::where('playerID', $request->playerID)->get());

        return response($data, 200);

    }

    public function post(Request $request)
    {
        if (!isset($request->playerID)) {

            return response('Invalid data!', 400);
        }

        $data = $this->prepareData($request->input());

        PlayerShipStuff::where('playerID', $request->playerID)->delete();

        foreach ($data as $item) {

            PlayerShipStuff::create($item);
        }

        return response('ok', 200);
    }

    protected function prepareData($data)
    {
        $prepared = [];

        foreach ($data['shipFloors'] as $floor) {

            foreach ($floor['floorCells'] as $cell) {

                $temp['playerID'] = $data['playerID'];
                $temp['floorIndex'] = $floor['floorIndex'];
                $temp = array_merge($temp, $cell);
                $prepared[] = $temp;
            }

        }

        return $prepared;
    }
}

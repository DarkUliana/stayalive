<?php

namespace App\Http\Controllers;

use App\ShipStuff;
use App\TechnologyQuantity;
use Illuminate\Http\Request;

class ShipStuffController extends Controller
{
    public function get(Request $request)
    {

        $data['shipFloors'] = ShipStuff::with('defaultItems')
            ->with(['recovers' => function($query) {
                $query->where('playerID', 0);
            }])->get()->toArray();

        foreach ($data['shipFloors'] as &$floor) {

            $floor['floorRecover'] = [];
            if (!empty($floor['recovers'])) {

                $floor['floorRecover'] = $floor['recovers'][0]['floorRecover'];

            }
            unset($floor['recovers']);

            $floor['floorCells'] = $floor['default_items'];
            unset($floor['default_items']);
        }


        $data['concreteItemsCounts'] = TechnologyQuantity::all()->toArray();

        return response($data, 200);

    }
}

<?php

namespace App\Http\Controllers;

use App\ShipStuff;
use App\TechnologyQuantity;
use Illuminate\Http\Request;

class ShipStuffController extends Controller
{
    public function get(Request $request)
    {

        $data['shipFloors'] = ShipStuff::with('defaultItems')->get()->toArray();

        foreach ($data['shipFloors'] as &$floor) {

            $floor['items'] = $floor['default_items'];
            unset($floor['default_items']);
        }


        $data['concreteItemsCounts'] = TechnologyQuantity::all()->toArray();

        return response($data, 200);

    }
}

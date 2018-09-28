<?php

namespace App\Http\Controllers;

use App\ShipStuff;
use App\TechnologyQuantity;
use Illuminate\Http\Request;

class ShipStuffController extends Controller
{
    public function get(Request $request)
    {

        $data['shipFloors'] = ShipStuff::with('items')->get()->toArray();

        $data['concreteItemsCounts'] = TechnologyQuantity::all()->toArray();

        return response($data, 200);

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\LootObjectCollection;
use App\LootObject;
use Illuminate\Http\Request;

class LootObjectController extends Controller
{
    public function get()
    {
        $objects = new LootObjectCollection(LootObject::all());

        return response($objects, 200);
    }
}

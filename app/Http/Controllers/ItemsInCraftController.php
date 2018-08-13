<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemInCraftCollection;
use Illuminate\Http\Request;
use App\ItemsInCraft;

class ItemsInCraftController extends Controller
{
    public function show(Request $request)
    {
        if (!isset($request->googleID)) {
            return response('Invalid data', 400);
        }

        $workbenches['workbenches'] = new ItemInCraftCollection(ItemsInCraft::where('googleID', $request->googleID)->get());
        $workbenches['googleID'] = $request->googleID;

        return response($workbenches, 200);
    }

    public function store(Request $request)
    {
        if (!isset($request->itemsInCraft) || !isset($request->googleID)) {
            return response('Invalid data', 400);
        }

        ItemsInCraft::where('googleID', $request->googleID)->delete();

        foreach ($request->itemsInCraft as $item) {

            $data = $item;
            $data['googleID'] = $request->googleID;
            ItemsInCraft::create($data);
        }
        return response('ok', 201);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemsInCraft;

class ItemsInCraftController extends Controller
{
    public function show(Request $request)
    {
        if (!isset($request->googleID)) {
            return response('Invalid data', 400);
        }

        $items['itemsInCraft'] = ItemsInCraft::where('googleID', $request->googleID)->get()->toArray();

        return response($items, 200);
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

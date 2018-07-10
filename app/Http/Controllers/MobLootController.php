<?php

namespace App\Http\Controllers;

use App\MobLoot;
use App\MobLootItem;
use Illuminate\Http\Request;

class MobLootController extends Controller
{
    public function index()
    {
        $loot = MobLoot::with('loot')->get()->toArray();

        return response(['itemsLists' => $loot], 200);
    }

    public function store(Request $request)
    {
        if (!isset($request->itemsLists)) {

            return response('Invalid data', 400);
        }

        foreach ($request->itemsLists as $value) {

            $data = $value;
            unset($data['loot']);

            $loot = MobLoot::create($data);

            foreach ($value['loot'] as $item) {

                $newItem = new MobLootItem($item);
                $loot->items()->save($newItem);
            }
        }

        return response('ok', 200);
    }
}

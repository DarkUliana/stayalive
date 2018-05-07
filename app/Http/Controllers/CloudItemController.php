<?php

namespace App\Http\Controllers;

use App\CloudItem;
use Illuminate\Http\Request;

class CloudItemController extends Controller
{
    public function getItems(Request $request)
    {
        if (!isset($request->googleID)) {
            return response('Invalid data', 400);
        }

        $items = [
            'googleID' => $request->googleID,
            'cloudItems' => CloudItem::where('googleID', $request->googleID)->where('isTaken', 0)->get()->toArray()
        ];
        return $items;
    }

    public function postItems(Request $request)
    {
//        var_dump($request->input()); die();
        if (!isset($request->googleID) || !isset($request->cloudItems)) {
            return response('Invalid data', 400);
        }
        foreach ($request->cloudItems as $item) {

            CloudItem::updateOrCreate(['googleID' => $request['googleID'], 'uniqueID' => $item['uniqueID']], $item);
        }

        return response('ok', 200);
    }
}

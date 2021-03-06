<?php

namespace App\Http\Controllers;

use App\Http\Resources\RestorableObjectCollection;
use App\RestorableObject;
use App\RestorableObjectCell;
use App\RestorableObjectItem;
use Illuminate\Http\Request;

class RestorableObjectController extends Controller
{
    public function index()
    {
        $objects = new RestorableObjectCollection(RestorableObject::all());

        return response(['restObjects' => $objects], 200);
    }

    public function store(Request $request)
    {
        if (!isset($request->restObjects)) {

            return response('Invalid data!', 400);
        }

        RestorableObject::truncate();
        RestorableObjectItem::truncate();

        foreach ($request->restObjects as $object) {

            $newObject = RestorableObject::create(['name' => $object['name']]);


            foreach ($object['TopRestorableList'] as $item) {

                $itemObj = new RestorableObjectItem(array_merge($item, ['isTopList' => 1]));
                $newObject->items()->save($itemObj);
            }

            foreach ($object['BottomRestorableList'] as $item) {

                $itemObj = new RestorableObjectItem(array_merge($item, ['isTopList' => 0]));
                $newObject->items()->save($itemObj);
            }

            if (isset($object['deckCells'])) {

                foreach ($object['deckCells'] as $cell) {

                    $newCell = new RestorableObjectCell($cell);
                    $newObject->cells()->save($newCell);
                }
            }



        }

        return response('ok', 200);
    }
}

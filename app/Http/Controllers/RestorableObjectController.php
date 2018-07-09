<?php

namespace App\Http\Controllers;

use App\Http\Resources\RestorableObjectCollection;
use App\RestorableObject;
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

            if (isset($object['TopResotorableList'])) {

                foreach ($object['TopResotorableList'] as $item) {

                    $itemObj = new RestorableObjectItem(array_merge($item, ['isTopList' => 1]));
                    $newObject->items()->save($itemObj);
                }
            }

            if (isset($object['BottomResotorableList'])) {

                foreach ($object['BottomResotorableList'] as $item) {

                    $itemObj = new RestorableObjectItem(array_merge($item, ['isTopList' => 0]));
                    $newObject->items()->save($itemObj);
                }
            }

        }

        return response('ok', 200);
    }
}

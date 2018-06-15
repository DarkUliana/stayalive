<?php

namespace App\Http\Controllers;

use App\RestorableObject;
use App\RestorableObjectSlot;
use Illuminate\Http\Request;

class RestorableObjectController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {

        if (!isset($request->restorableObjects)) {

            return response('Invalid data', 400);
        }

        foreach ($request->restorableObjects as $object) {

            $json = json_decode($object['objectData']);
            $objectData = [
                'objectKey' => $object['objectKey'],
                'googleID' => $json->googleID
            ];

            $newObject = RestorableObject::firstOrCreate($objectData);
            RestorableObjectSlot::where('restorableObjectID', $newObject->ID)->delete();

            foreach ($json->slotsData as $slot) {

                $slotData = (array)json_decode($slot->slotInfo);
                $slotData['itemID'] = $slot->itemID;

                $newSlot = new RestorableObjectSlot($slotData);

                $newObject->slots()->save($newSlot);
            }

        }

        return response('ok', 200);
    }
}

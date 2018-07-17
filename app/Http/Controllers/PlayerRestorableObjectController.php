<?php

namespace App\Http\Controllers;

use App\PlayerRestorableObject;
use App\PlayerRestorableObjectSlot;
use Illuminate\Http\Request;

class PlayerRestorableObjectController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->googleID)) {
            return response('Invalid data', 400);
        }

        $objects = PlayerRestorableObject::where('googleID', $request->googleID)->get();

        $restorableObjects = [];

        foreach ($objects as $object) {

            $temp['objectKey'] = $object->objectKey;
            $temp['objectData'] = [];
//            $temp['objectData']['googleID'] = $object->googleID;

            foreach ($object->slots as $slot) {

                $slotInfo = $slot->toArray();
                unset($slotInfo['itemID']);

                $temp['objectData']['slotsData'][] = [

                    'slotInfo' => json_encode($slotInfo),
                    'itemID' => $slot->itemID

                ];
                $temp['objectData']['isBuilded'] = $object->isBuilded;
                $temp['objectData']['SaveKey'] = $object->SaveKey;

            }
            $temp['objectData'] = json_encode($temp['objectData']);
            $restorableObjects[] = $temp;
        }

        $return = [
            'googleID' => $request->googleID,
            'restorableObjects' => $restorableObjects
        ];

        return response($return, 200);
    }

    public function store(Request $request)
    {

        if (!isset($request->restorableObjects) || !isset($request->googleID)) {

            return response('Invalid data', 400);
        }

        foreach ($request->restorableObjects as $object) {

            $json = json_decode($object['objectData']);

            $objectData = [
                'objectKey' => $object['objectKey'],
                'googleID' => $request->googleID

            ];

            $newData = [
                'isBuilded' => $json->isBuilded,
                'SaveKey' => $json->SaveKey
            ];


            $newObject = PlayerRestorableObject::updateOrCreate($objectData, $newData);
            PlayerRestorableObjectSlot::where('restorableObjectID', $newObject->ID)->delete();

            foreach ($json->slotsData as $slot) {

                $slotData = (array)json_decode($slot->slotInfo);
                $slotData['itemID'] = $slot->itemID;

                $newSlot = new PlayerRestorableObjectSlot($slotData);

                $newObject->slots()->save($newSlot);
            }

        }

        return response('ok', 200);
    }
}

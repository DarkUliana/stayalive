<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerRepairItemCollection;
use App\PlayerRepairItem;
use App\PlayerRepairItemPart;
use Illuminate\Http\Request;

class PlayerRepairItemController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->playerID)) {

            return response('Invalid data!', 400);
        }

        $repairItems = new PlayerRepairItemCollection(PlayerRepairItem::where('playerID', $request->playerID)->get());

        return response($repairItems, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->playerID) || !isset($request->repairItems)) {

            return response('Invalid data!', 400);
        }

        $oldItems = PlayerRepairItem::where('playerID', $request->playerID)->get();

        foreach ($oldItems as $oldItem) {
            $oldItem->delete();
        }

        foreach ($request->repairItems as $item) {

            $data = $item;
            $data['playerID'] = $request->playerID;
            unset($data['repairParts']);

            $object = PlayerRepairItem::create($data);

            foreach ($item['repairParts'] as $part) {

                $partData = [
                    'repairItemID' => $object->ID,
                    'itemID' => $part['id'],
                    'count' => $part['count']
                ];

                PlayerRepairItemPart::create($partData);
            }
        }

        return response('ok', 200);
    }
}

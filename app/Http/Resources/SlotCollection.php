<?php

namespace App\Http\Resources;

use App\PlayerBodyPosition;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SlotCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $slots = $this->collection->toArray();
        $array['slotsData'] = [];

        $playerID = getPlayerID($request->localID);

        foreach ($slots as $value) {

            $newValue = $value;
            $itemID = $newValue['itemID'];
            unset($newValue['itemID']);

            $array['slotsData'][] = [
                'slotInfo' => json_encode($newValue),
                'itemID' => $itemID
            ];
        }

        if ($request->segment(2) == 'player-body') {

            $position = PlayerBodyPosition::where('playerID', $playerID)->first();

            if (!$position) {

                $array['sceneName'] = 'L01_Home';
                $array['position'] = ['x' => 0, 'y' => 0, 'z' => 0];
            } else {

                $array['sceneName'] = $position->sceneName;
                $array['position'] = $position->toArray();

            }
        }

        return $array;
    }
}

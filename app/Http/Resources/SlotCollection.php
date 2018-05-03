<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SlotCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $slots = $this->collection->toArray();
        $array['slotsData'] = [];
        foreach ($slots as $value) {
            $newValue = $value;
            $itemID = $newValue['itemID'];
            unset($newValue['itemID']);
            $array['slotsData'][] = [
                'slotInfo' => json_encode($newValue),
                'itemID' => $itemID
            ];
        }

        return $array;
    }
}

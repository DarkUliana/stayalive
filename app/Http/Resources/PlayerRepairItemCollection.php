<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PlayerRepairItemCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $repairItems['localID'] = $request->localID;
        $repairItems['repairItems'] = [];

        foreach ($this->collection as $item) {

            $temp = $item->toArray();
            $temp['repairParts'] = [];

            foreach ($item->parts as $part) {

                $temp['repairParts'][] = [
                    'id' => $part->itemID,
                    'count' => $part->count
                ];
            }

            $repairItems['repairItems'][] = $temp;
        }

        return $repairItems;
    }
}

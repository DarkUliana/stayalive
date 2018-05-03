<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TechnologyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $collection = $this->collection->toArray();

        $technologies = [];

        foreach ($collection as $value) {

            $tempTech = $value;
            $tempTech['id'] = $tempTech['ID'];
            unset($tempTech['ID']);
            unset($tempTech['items']);

            $tempTech['oppenedItems'] = [];

            foreach ($value['items'] as $val) {
                $tempTech['oppenedItems'][] = $val['itemID'];
            }

            $technologies['technologies'][] = $tempTech;
        }

        return $technologies;
    }
}

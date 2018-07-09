<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RestorableObjectCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        $array = [];
        foreach ($this->collection as $object) {

            $temp = $object->toArray();

            $temp['TopRestorableList'] = $object->items()->where('isTopList', 1)->get()->toArray();
            $temp['BottomRestorableList'] = $object->items()->where('isTopList', 0)->get()->toArray();

            $array[] = $temp;
        }

        return $array;
    }
}

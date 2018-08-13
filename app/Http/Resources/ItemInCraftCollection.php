<?php
/**
 * Created by PhpStorm.
 * User: Uliana
 * Date: 13.08.2018
 * Time: 15:24
 */

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemInCraftCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray()
    {
        $workbenches = [];

        foreach ($this->collection as $item) {

            $temp['index'] = $item['index'];
            $temp['techType'] = $item['techType'];
            $temp['itemInCraft'] = $item;

            unset($temp['itemInCraft']['index']);
            unset($temp['itemInCraft']['techType']);

            $workbenches[] = $temp;
        }

        return $workbenches;
    }


}
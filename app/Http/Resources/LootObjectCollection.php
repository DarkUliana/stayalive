<?php
/**
 * Created by PhpStorm.
 * User: Uliana
 * Date: 14.09.2018
 * Time: 10:42
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class LootObjectCollection extends ResourceCollection
{

    /**
     * Transform the resource into an array.
     *
     *
     * @return array
     */
    public function toArray($request)
    {
        $objects = [];

        foreach ($this->collection as $item) {

            $temp['key'] = $item->key;
            $temp['collections'] = [];

            foreach ($item->collections as $collection) {

                $tempCollection['chance'] = $collection->collection->chance;
                $tempCollection['items'] = $collection->collection->items->toArray();
                $temp['collections'][] = $tempCollection;
            }
            $objects[] = $temp;
        }

        return ['itemsCollections' => $objects];
    }
}
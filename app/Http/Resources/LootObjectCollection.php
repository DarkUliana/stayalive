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
        $temp = [];

        foreach ($this->collection as $object) {

            $temp[$object->key]['key'] = $object->key;


            $tempCollection = $object->collection->toArray();
            $tempCollection['items'] = [];

            foreach ($object->collection->items as $item) {

                $tempCollection['items'][] = $item->toArray();
            }
            $temp[$object->key]['collections'][] = $tempCollection;
        }

        return ['itemsCollections' => array_values($temp)];
    }
}
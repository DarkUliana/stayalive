<?php
/**
 * Created by PhpStorm.
 * User: Uliana
 * Date: 12.09.2018
 * Time: 17:47
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class DropItemCollection extends ResourceCollection
{

    public function toArray($request)
    {
        $drop = [];

        foreach ($this->collection as $item) {

            $drop[$item->key]['key'] = $item->key;
            $drop[$item->key][$item->lootType] = [
                'minItems' => $item->minItems,
                'maxItems' => $item->maxItems,
                'loot' => $item->loot->toArray()
            ];

        }

        return ['items' => array_values($drop)];
    }
}
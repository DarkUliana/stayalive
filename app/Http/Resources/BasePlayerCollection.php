<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 12.06.2018
 * Time: 15:46
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class BasePlayerCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $playerArray = [];

        foreach ($this->collection as $property) {

            $playerArray[$property->property] = $this->toType($property->type, $property->value);
        }

        return $playerArray;
    }

    protected function toType($type, $value)
    {
        switch ($type) {
            case 'string':
                return $value;
            case 'integer':
                return (integer)$value;
            case 'double':
                return (double)$value;
        }
    }
}
<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $itemsArray = [];

        foreach ($this->collection as $item) {

            $itemProperties = $item->toArray();
            unset($itemProperties['propertyID']);

            $itemProperties['Id'] = $itemProperties['ID'];
            unset($itemProperties['ID']);

            foreach ($item->properties as $property) {

                $itemProperties[$property->propertyName->name] = $this->format($property['propertyValue'], $property->propertyName->propertyType);
            }

            $itemsArray[] = [
                'Type' => $item->type->serializeType,
                'Json' => json_encode($itemProperties)
            ];
        }

        return ["allItemsData" => $itemsArray];
    }

    protected function format($string, $type)
    {
        switch ($type) {
            case 'integer':
                return (int)$string;
                break;
            case 'float':
                return (float)$string;
                break;
            case 'double':
                return (double)$string;
                break;
            case 'string':
                return (string)$string;
                break;
            default:
                return $string;
        }
    }
}

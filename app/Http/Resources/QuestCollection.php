<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.05.2018
 * Time: 10:08
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class QuestCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $questsArray = [];

        foreach ($this->collection as $quest) {

            $itemFields = $quest->toArray();

            $itemFields['questID'] = $itemFields['ID'];
            unset($itemFields['ID']);

            foreach ($quest->fields as $field) {

                $itemFields[$field->fieldName->name] = $field['value'];
            }

            $questsArray[] = [
                'Type' => $quest->type->type,
                'Json' => json_encode($itemFields)
            ];
        }

        return ["allQuestsData" => $questsArray];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Uliana
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
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $questsArray = [];

        foreach ($this->collection as $quest) {

            $itemFields = $quest->toArray();

            $itemFields['questID'] = $itemFields['ID'];
            unset($itemFields['ID']);

            if (isset($quest->field)) {

                switch ($quest->field->fieldName->type) {
                    case 'integer':
                        $itemFields[($quest->field->fieldName->name)] = (integer)$quest->field->value;
                        break;
                    case 'double':
                        $itemFields[($quest->field->fieldName->name)] = (double)$quest->field->value;
                        break;
                    case 'string':
                        $itemFields[($quest->field->fieldName->name)] = $quest->field->value;
                        break;
                }
            }

            $questsArray[] = [
                'Type' => $quest->type->type,
                'Json' => json_encode($itemFields)
            ];

        }

        return ["allQuestsData" => $questsArray];
    }
}
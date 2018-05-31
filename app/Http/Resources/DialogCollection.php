<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class DialogCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $dialogsArray = [];

        foreach ($this->collection as $dialog) {

            $tempDialog = [
                'id' => $dialog->questID,
                'questID' => $dialog->questID,
                'phrases' => []
            ];

            foreach ($dialog->descriptions->sortBy('number') as $description) {

//                var_dump($description); die();
                $tempDialog['phrases'][] = [
                    'speaker' => $description->speaker,
                    'phrase' => $description->description->key
                ];
            }

            $dialogsArray[] = $tempDialog;
        }

        return $dialogsArray;
    }
}
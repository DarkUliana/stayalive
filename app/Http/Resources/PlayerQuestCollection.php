<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.05.2018
 * Time: 16:13
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class PlayerQuestCollection extends ResourceCollection
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

            if ($quest->type == 'simple') {
                $questsArray['questsData'][] = [
                    'questControllerData' => json_encode(['progress' => $quest->progress]),
                    'questID' => $quest->questID
                ];
            } else {
                $questsArray['starQuest'] = [
                    'questControllerData' => json_encode(['progress' => $quest->progress]),
                    'questID' => $quest->questID
                ];
            }

        }

        $questsArray['googleID'] = $request->googleID;

        return $questsArray;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 08.05.2018
 * Time: 16:13
 */

namespace App\Http\Resources;

use App\PlayerQuestReplacement;
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

            $temp = [
                'questControllerData' => json_encode([
                    'progress' => $quest->progress,
                    'ID' => $quest->ID
                ]),
                'questID' => $quest->questID,
            ];

            if ($quest->type == 'simple') {

                $questsArray['questsData'][] = $temp;
            }  else {

                $questsArray['starQuest'] = $temp;
            }

        }

        $questsArray['googleID'] = $request->googleID;

        $replacement = PlayerQuestReplacement::where('googleID', $request->googleID)->first();

        if(!$replacement) {

            $replacement = PlayerQuestReplacement::create(['googleID' => $request->googleID, 'replaced' => 0]);
        }

        $questsArray['replaced'] = $replacement->replaced;


        return $questsArray;
    }
}
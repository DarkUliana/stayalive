<?php
/**
 * Created by PhpStorm.
 * User: Uliana
 * Date: 14.12.2018
 * Time: 10:32
 */

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class SceneEnemyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $array = [];

        foreach ($this->collection as $item) {

            $array['concreteSceneEnemies'][$item->sceneName]['sceneName'] = $item->sceneName;


            $array['concreteSceneEnemies'][$item->sceneName]['concreteAreaEnemies'][$item->areaKey]['areaKey'] = $item['areaKey'];
            $array['concreteSceneEnemies'][$item->sceneName]['concreteAreaEnemies'][$item->areaKey]['concreteEnemies'] = $item->item;

        }

        $array['concreteSceneEnemies'] = array_values($array['concreteSceneEnemies']);

        foreach ($array['concreteSceneEnemies'] as &$enemy) {

            $enemy['concreteAreaEnemies'] = array_values($enemy['concreteAreaEnemies']);
        }

        return $array;

    }
}
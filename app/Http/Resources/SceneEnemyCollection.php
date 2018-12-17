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

            $array[$item->sceneName]['sceneName'] = $item->sceneName;
            $array[$item->sceneName]['concreteAreaEnemies'][$item->areaKey]['areaKey'] = $item['areaKey'];

            $enemy = $item->toArray();
            unset($enemy['sceneName']);
            unset($enemy['areaKey']);
            $array[$item->sceneName]['concreteAreaEnemies'][$item->areaKey]['concreteEnemies'][] = $enemy;

        }

        $array = array_values($array);

        foreach ($array as &$enemy) {

            $enemy['concreteAreaEnemies'] = array_values($enemy['concreteAreaEnemies']);
        }

        return ['concreteSceneEnemies' => $array];

    }
}
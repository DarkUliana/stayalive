<?php

namespace App\Http\Controllers;

use App\Http\Resources\SceneEnemyCollection;
use App\SceneEnemy;
use App\SceneEnemyItem;
use Illuminate\Http\Request;

class SceneEnemyController extends Controller
{
    public function get()
    {
        $data = new SceneEnemyCollection(SceneEnemy::all());

        return response($data, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->concreteSceneEnemies)) {

             return response('Invalid', 200);
        }

        SceneEnemy::truncate();
        SceneEnemyItem::truncate();
        foreach ($request->concreteSceneEnemies as $scene) {

            foreach ($scene['concreteAreaEnemies'] as $area) {

                $sceneEnemy = SceneEnemy::create(['sceneName' => $scene['sceneName'], 'areaKey' => $area['areaKey']]);

                foreach ($area['concreteEnemies'] as $enemy) {

                    $newEnemy = new SceneEnemyItem($enemy);
                    $sceneEnemy->item()->save($newEnemy);
                }

            }
        }

        return response('ok', 200);
    }
}

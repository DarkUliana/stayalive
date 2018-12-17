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

        $sceneEnemy = [];
        foreach ($request->concreteSceneEnemies as $scene) {

            $sceneEnemy['sceneName'] = $scene['sceneName'];


            foreach ($scene['concreteAreaEnemies'] as $area) {

                $sceneEnemy['areaKey'] = $area['areaKey'];

                foreach ($area['concreteEnemies'] as $enemy) {

                    SceneEnemy::create(array_merge($sceneEnemy, $enemy));
                }

            }
        }

        return response('ok', 200);
    }
}

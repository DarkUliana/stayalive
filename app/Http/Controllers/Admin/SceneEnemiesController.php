<?php

namespace App\Http\Controllers\Admin;

use App\Enemy;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SceneEnemy;
use Illuminate\Http\Request;

class SceneEnemiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $sceneenemy = SceneEnemy::latest()->paginate($perPage);
        } else {
            $sceneenemy = SceneEnemy::latest()->paginate($perPage);
        }

        return view('admin.scene-enemies.index', compact('sceneenemy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $enemies = Enemy::all();
        $sceneNames = SceneEnemy::all()->pluck('sceneName')->unique();
        $lootKeys = SceneEnemy::all()->pluck('lootKey')->unique();

        return view('admin.scene-enemies.create', compact('enemies', 'sceneNames', 'lootKeys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        SceneEnemy::create($requestData);

        return redirect('scene-enemies')->with('flash_message', 'SceneEnemy added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $sceneenemy = SceneEnemy::findOrFail($id);

        return view('admin.scene-enemies.show', compact('sceneenemy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $sceneenemy = SceneEnemy::findOrFail($id);
        $enemies = Enemy::all();
        $sceneNames = SceneEnemy::all()->pluck('sceneName')->unique();
        $lootKeys = SceneEnemy::all()->pluck('lootKey')->unique();

        return view('admin.scene-enemies.edit', compact('sceneenemy', 'enemies', 'sceneNames', 'lootKeys'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $sceneenemy = SceneEnemy::findOrFail($id);
        $sceneenemy->update($requestData);

        return redirect('scene-enemies')->with('flash_message', 'SceneEnemy updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        SceneEnemy::destroy($id);

        return redirect('scene-enemies')->with('flash_message', 'SceneEnemy deleted!');
    }
}

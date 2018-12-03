<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SceneChest;
use Illuminate\Http\Request;

class SceneChestsController extends Controller
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
            $scenechests = SceneChest::latest()->paginate($perPage);
        } else {
            $scenechests = SceneChest::latest()->paginate($perPage);
        }

        return view('admin.scene-chests.index', compact('scenechests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.scene-chests.create');
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
        
        SceneChest::create($requestData);

        return redirect('scene-chests')->with('flash_message', 'SceneChest added!');
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
        $scenechest = SceneChest::findOrFail($id);

        return view('admin.scene-chests.show', compact('scenechest'));
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
        $scenechest = SceneChest::findOrFail($id);

        return view('admin.scene-chests.edit', compact('scenechest'));
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
        
        $scenechest = SceneChest::findOrFail($id);
        $scenechest->update($requestData);

        return redirect('scene-chests')->with('flash_message', 'SceneChest updated!');
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
        SceneChest::destroy($id);

        return redirect('scene-chests')->with('flash_message', 'SceneChest deleted!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LootObject;
use Illuminate\Http\Request;

class LootObjectsController extends Controller
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
            $lootobjects = LootObject::latest()->paginate($perPage);
        } else {
            $lootobjects = LootObject::latest()->paginate($perPage);
        }

        return view('admin.loot-objects.index', compact('lootobjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.loot-objects.create');
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
        
        LootObject::create($requestData);

        return redirect('loot-objects')->with('flash_message', 'LootObject added!');
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
        $lootobject = LootObject::findOrFail($id);

        return view('admin.loot-objects.show', compact('lootobject'));
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
        $lootobject = LootObject::findOrFail($id);

        return view('admin.loot-objects.edit', compact('lootobject'));
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
        
        $lootobject = LootObject::findOrFail($id);
        $lootobject->update($requestData);

        return redirect('loot-objects')->with('flash_message', 'LootObject updated!');
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
        LootObject::destroy($id);

        return redirect('loot-objects')->with('flash_message', 'LootObject deleted!');
    }
}

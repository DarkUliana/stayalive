<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LootCollection;
use Illuminate\Http\Request;

class LootCollectionsController extends Controller
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
            $lootcollections = LootCollection::latest()->paginate($perPage);
        } else {
            $lootcollections = LootCollection::latest()->paginate($perPage);
        }

        return view('admin.loot-collections.index', compact('lootcollections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.loot-collections.create');
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
        
        LootCollection::create($requestData);

        return redirect('loot-collections')->with('flash_message', 'LootCollection added!');
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
        $lootcollection = LootCollection::findOrFail($id);

        return view('admin.loot-collections.show', compact('lootcollection'));
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
        $lootcollection = LootCollection::findOrFail($id);

        return view('admin.loot-collections.edit', compact('lootcollection'));
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
        
        $lootcollection = LootCollection::findOrFail($id);
        $lootcollection->update($requestData);

        return redirect('loot-collections')->with('flash_message', 'LootCollection updated!');
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
        LootCollection::destroy($id);

        return redirect('loot-collections')->with('flash_message', 'LootCollection deleted!');
    }
}

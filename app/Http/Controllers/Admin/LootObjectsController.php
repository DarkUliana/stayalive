<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LootObjectCollection;
use App\Item;
use App\LootCollection;
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
        $collections = LootCollection::all();
        $items = Item::all();

        return view('admin.loot-objects.create', compact('collections', 'items'));
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
//        var_dump($requestData); die();
        unset($requestData['collections']);

        $object = LootObject::create($requestData);

        if (isset($request->collections)) {

            foreach ($request->collections as $collection) {

                $newCollection = new LootObjectCollection(['lootCollectionID' => $collection]);
                $object->collections()->save($newCollection);
            }
        }

        return redirect('loot-objects')->with('flash_message', 'LootObject added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $lootobject = LootObject::findOrFail($id);
        $collections = LootCollection::all();
        $items = Item::all();

        return view('admin.loot-objects.edit', compact('lootobject', 'collections', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        unset($requestData['collections']);

        $object = LootObject::findOrFail($id);
        $object->update($requestData);

        LootObjectCollection::where('lootObjectID', $object->ID)->delete();

        if (isset($request->collections)) {

            foreach ($request->collections as $collection) {

                $newCollection = new LootObjectCollection(['lootCollectionID' => $collection]);
                $object->collections()->save($newCollection);
            }
        }

        if ($request->ajax()) {

            return response('ok', 200);
        }

        return redirect('loot-objects')->with('flash_message', 'LootObject updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        LootObject::destroy($id);
        LootObjectCollection::where('lootObjectID', $id)->delete();

        if ($request->ajax()) {

            return response('deleted', 200);
        }

        return redirect('loot-objects')->with('flash_message', 'LootObject deleted!');
    }

    public function getCollectionForLootObject($id = 0) {

        $collection = LootObjectCollection::where('lootCollectionID', $id)->first();
        $items = Item::all();
        return view('admin.loot-objects.edit-collection', compact('collection', 'items'));
    }
}

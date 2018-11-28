<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LootObject;
use App\LootObjectCollection;
use App\Item;
use App\LootCollection;
use App\LootCollectionItem;
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
        session(['itemsParams' => $request->getQueryString()]);

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $lootcollections = LootCollection::where('name', 'LIKE', "%$keyword%")->paginate($perPage);
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
        $items = Item::all();
        return view('admin.loot-collections.create', compact('items'));
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

        unset($requestData['items']);
        unset($requestData['lootObjectID']);
        
        $collection = LootCollection::create($requestData);

        if (isset($request->items)) {

            foreach ($request->items as $item) {

                $newItem = new LootCollectionItem($item);
                $collection->items()->save($newItem);
            }
        }

        if ($request->ajax()) {

            if (isset($request->lootObjectID)) {

                LootObjectCollection::create(['lootObjectID' => $request->lootObjectID, 'lootCollectionID' => $collection->ID]);
            }

            $data = [
                'value' => $collection->name,
                'id' => $collection->ID
            ];
            return response($data, 200);
        }

        return redirect("loot-collections/$collection->ID/edit")->with('flash_message', 'LootCollection added!');
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
        $items = Item::all();

        return view('admin.loot-collections.edit', compact('lootcollection', 'items'));
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

        unset($requestData['items']);

        $collection = LootCollection::findOrFail($id);
        $collection->update($requestData);

        LootCollectionItem::where('lootCollectionID', $collection->ID)->delete();

        if (isset($request->items)) {

            foreach ($request->items as $item) {

                $newItem = new LootCollectionItem($item);
                $collection->items()->save($newItem);
            }
        }

        return back()->with('flash_message', 'LootCollection updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        LootCollection::destroy($id);
        LootCollectionItem::where('lootCollectionID', $id)->delete();
        LootObjectCollection::where('lootCollectionID', $id)->delete();

        if ($request->ajax()) {

            return response('deleted', 200);
        }

        return redirect('loot-collections' . getQueryParams($request))->with('flash_message', 'LootCollection deleted!');
    }

    public function getItem(Request $request)
    {
        $items = Item::all();
        $index = $request->index + 1;

        return view('admin.loot-collections.item', compact('items', 'index'));
    }

    public function getLootCollectionObject($id)
    {
        $objectID = LootObjectCollection::where('lootCollectionID', $id)->first();

        if ($objectID == null) {

            return response('not found', 404);
        }

        $object = LootObject::where('ID', $objectID->lootObjectID)->first();

        return response($object, 200);
    }
}

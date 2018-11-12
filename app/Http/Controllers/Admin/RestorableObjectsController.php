<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item;
use App\RestorableObject;
use App\RestorableObjectCell;
use App\RestorableObjectItem;
use App\ShipStuff;
use Illuminate\Http\Request;

class RestorableObjectsController extends Controller
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
            $restorableObjects = RestorableObject::latest()->paginate($perPage);
        } else {
            $restorableObjects = RestorableObject::latest()->paginate($perPage);
        }

        return view('admin.restorable-objects.index', compact('restorableObjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $items = Item::all();

        $collection = ShipStuff::with('defaultItems')->get();

        $shipstuffs = ShipStuffsController::sortedItems($collection);

        return view('admin.restorable-objects.create', compact('items', 'shipstuffs'));
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

        $this->validate($request, ['name' => 'required']);

        $requestData = $request->all();
        $newObj = RestorableObject::create(['name' => $requestData['name']]);

        if (isset($requestData['topListItems'])) {

            foreach ($requestData['topListItems'] as $item) {

                $itemObj = new RestorableObjectItem($item);
                $newObj->items()->save($itemObj);
            }
        }

        if (isset($requestData['bottomListItems'])) {

            foreach ($requestData['bottomListItems'] as $item) {

                $itemObj = new RestorableObjectItem($item);
                $newObj->items()->save($itemObj);
            }
        }

        if (isset($requestData['deckCells'])) {

            foreach ($requestData['deckCells'] as $cell) {

                $newCell = new RestorableObjectCell(['floor' => $cell['floor'], 'index' => $cell['index']]);
                $newObj->cells()->save($newCell);
            }
        }
        

        return redirect('restorable-objects')->with('flash_message', 'Restorable Object added!');
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
        $restorableObject = RestorableObject::findOrFail($id);
        $topList = $restorableObject->items()->where('isTopList', 1)->get();
        $bottomList = $restorableObject->items()->where('isTopList', 0)->get();

        return view('admin.restorable-objects.show', compact('restorableObject', 'topList', 'bottomList'));
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
        $restorableObject = RestorableObject::findOrFail($id);
        $topListItems = $restorableObject->items()->where('isTopList', 1)->get();
        $bottomListItems = $restorableObject->items()->where('isTopList', 0)->get();
        $items = Item::all();

        $collection = ShipStuff::with('defaultItems')->get();

        $shipstuffs = ShipStuffsController::sortedItems($collection);

        return view('admin.restorable-objects.edit', compact('restorableObject', 'items', 'topListItems',
            'bottomListItems', 'shipstuffs'));
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

        $this->validate($request, ['name' => 'required']);
        $requestData = $request->all();

        $obj = RestorableObject::find($id);
        $obj->update(['name' => $requestData['name']]);

        RestorableObjectItem::where('restorableObjectID', $id)->delete();

        if (isset($requestData['topListItems'])) {

            foreach ($requestData['topListItems'] as $item) {

                $itemObj = new RestorableObjectItem($item);
                $obj->items()->save($itemObj);
            }
        }

        if (isset($requestData['bottomListItems'])) {

            foreach ($requestData['bottomListItems'] as $item) {

                $itemObj = new RestorableObjectItem($item);
                $obj->items()->save($itemObj);
            }
        }

        RestorableObjectCell::where('restorableObjectID', $id)->delete();

        if (isset($requestData['deckCells'])) {

            foreach ($requestData['deckCells'] as $cell) {

                $newCell = new RestorableObjectCell(['floor' => $cell['floor'], 'index' => $cell['index']]);
                $obj->cells()->save($newCell);
            }
        }

        return redirect('restorable-objects')->with('flash_message', 'Restorable Object updated!');
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
        RestorableObject::destroy($id);
        RestorableObjectItem::where('restorableObjectID', $id)->delete();

        return redirect('restorable-objects')->with('flash_message', 'Restorable Object deleted!');
    }

    public function getItem(Request $request)
    {
        if(!$request->ajax()) {

            abort(404);
        }

        $items = Item::all();
        $arrayName = $request->isTop ? 'topListItems' : 'bottomListItems';
        $counter = $request->counter+1;

        return view('admin.restorable-objects.item', compact('items', 'arrayName', 'counter'));
    }
}

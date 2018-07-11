<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item;
use App\MobLoot;
use App\MobLootItem;
use Illuminate\Http\Request;

class MobLootController extends Controller
{
    protected $validationProperties = [

        'key' => 'required|string',
        'minRandomSize' => 'required|integer',
        'maxRandomSize' => 'required|integer',
        'loot' => 'required|array',
        'loot.*.itemID' => 'required|integer',
        'loot.*.minAmount' => 'required|integer',
        'loot.*.maxAmount' => 'required|integer',
        'loot.*.chance' => 'required|numeric'
    ];
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
            $loot = MobLoot::latest()->paginate($perPage);
        } else {
            $loot = MobLoot::latest()->paginate($perPage);
        }

        return view('admin.mobs-loot.index', compact('loot'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $items = Item::all();

        return view('admin.mobs-loot.create', compact('items'));
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
        $this->validate($request, $this->validationProperties);

        $requestData = $request->all();
        unset($requestData['loot']);
        
        $mobLoot = MobLoot::create($requestData);

        foreach ($request->loot as $item) {

            $newItem = new MobLootItem($item);

            $mobLoot->loot()->save($newItem);
        }

        return redirect('mobs-loot')->with('flash_message', 'MobLoot added!');
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
        $loot = MobLoot::findOrFail($id);

        return view('admin.mobs-loot.show', compact('loot'));
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
        $loot = MobLoot::findOrFail($id);
        $items = Item::all();

        return view('admin.mobs-loot.edit', compact('loot', 'items'));
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

        $this->validate($request, $this->validationProperties);

        $requestData = $request->all();
        unset($requestData['loot']);

        $mobLoot = MobLoot::findOrFail($id);
        $mobLoot->update($requestData);

        MobLootItem::where('mobLootID', $id)->delete();

        foreach ($request->loot as $item) {

            $newItem = new MobLootItem($item);

            $mobLoot->loot()->save($newItem);
        }

        return redirect('mobs-loot')->with('flash_message', 'MobLoot updated!');
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
        MobLoot::destroy($id);
        MobLootItem::where('mobLootID', $id)->delete();

        return redirect('mobs-loot')->with('flash_message', 'MobLoot deleted!');
    }

    public function getItem(Request $request)
    {
        $items = Item::all();
        $index = $request->index + 1;

        return view('admin.mobs-loot.item', compact('items', 'index'));
    }

}

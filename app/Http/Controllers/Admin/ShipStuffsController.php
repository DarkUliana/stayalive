<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ShipCellType;
use App\ShipStuff;
use App\ShipStuffItem;
use App\TechnologyType;
use Illuminate\Http\Request;

class ShipStuffsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        $collection = ShipStuff::with('items')->get();

        $shipstuffs = $this->sortedItems($collection);

        $technologyTypes = TechnologyType::all();
        $cellTypes = ShipCellType::all();

        return view('admin.ship-stuffs.index', compact('shipstuffs', 'technologyTypes', 'cellTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $maxFloor = ShipStuff::max('floorIndex');
        $floor = new ShipStuff([
            'floorIndex' => ++$maxFloor,
            'deckWidth' => 1
        ]);
        $create = true;

        return view('admin.ship-stuffs.floor-modal', compact('floor', 'create'));
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

        $floor = ShipStuff::create($requestData);
        for ($i = 0; $i < $floor->deckWidth; ++$i) {

            $cell = new ShipStuffItem(['cellIndex' => 0, 'cellType' => 1, 'techLevel' => '']);
            $floor->defaultItems()->save($cell);
        }

        return redirect('ship-stuff')->with('flash_message', 'ShipStuff added!');
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
        $shipstuff = ShipStuff::findOrFail($id);

        return view('admin.ship-stuffs.show', compact('shipstuff'));
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
        $floor = ShipStuff::findOrFail($id);
        $create = false;

        return view('admin.ship-stuffs.floor-modal', compact('floor', 'create'));
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

        $shipstuff = ShipStuff::findOrFail($id);
        $shipstuff->update($requestData);

        return redirect('ship-stuff')->with('flash_message', 'ShipStuff updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        ShipStuff::destroy($id);
        ShipStuffItem::where('stuffID', $id)->delete();

        return redirect('ship-stuff')->with('flash_message', 'ShipStuff deleted!');
    }

    public function sortedItems($collections)
    {

        foreach ($collections as $collection) {

            $array = [];
            foreach ($collection->items as $key => $item) {


                $array[(int) ($item->cellIndex / $collection->deckWidth)][$key] = $item;

            }

            foreach ($array as &$one) {

                sort($one);
            }

            $array = collect(array_reverse($array));

            $collection->items = $array;


        }

        return collect($collections);
    }

    public function getShipModal($id = 0)
    {

        $item = ShipStuffItem::where('ID', $id)->first();
        $cellTypes = ShipCellType::all();
        $technologyTypes = TechnologyType::all();
        $last = false;
        if ($item->cellIndex == ShipStuffItem::where('stuffID', $item->stuffID)->max('cellIndex')) {

            $last = true;
        }

        return view('admin.ship-stuffs.cell-modal', compact('item', 'cellTypes', 'technologyTypes', 'last'));
    }

    public function getShipFloorCell($id = 0)
    {

        $lastCell = ShipStuffItem::where('stuffID', $id)->max('cellIndex');
        $item = ShipStuffItem::create([
            'stuffID' => $id,
            'cellIndex' => $lastCell + 1,
            'cellType' => 0,
            'technologyType' => 1,
            'techLevel' => 0
        ]);

        return view('admin.ship-stuffs.cell', compact('item'));
    }

    public function deleteShipFloorCell($id = 0)
    {
        ShipStuffItem::destroy($id);

        return response('ok', 200);
    }

    public function updateShipFloorCell(Request $request)
    {
        ShipStuffItem::where('ID', $request->ID)->update($request->all());
        $item = ShipStuffItem::find($request->ID);

        return view('admin.ship-stuffs.cell', compact('item'));
    }
}

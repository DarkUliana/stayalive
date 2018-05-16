<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item;
use App\ItemType;
use App\Property;
use Illuminate\Http\Request;
use App\ItemProperty;
use Illuminate\Support\Facades\DB;

class ItemsController extends Controller
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
        $filter = $request->get('filter');
        $sort = $request->get('sort');

        $type = 'asc';
        if (!empty ($request->get('type'))) {
            $type = $request->get('type');
        }
        $perPage = 25;

        $items = Item::where([]);

        if (!empty($keyword)) {
            $items = $items->where('name', 'like', "%$keyword%");
        }
        if (!empty($filter)) {
            $items = $items->where('InventorySlotType', $filter);
        }
        if (!empty($sort)) {
            $items = $items->orderBy($sort, $type);
        }

        if (empty($keyword) && empty($filter) && empty($sort)) {
            $items = $items->latest();
        }

        $items = $items->paginate($perPage);

        $types = $this->getTypes();

        if ($request->ajax()) {

            $array = [
                'pagination' => (string)$items->appends(['search' => $request->get('search'),
                    'filter' => $request->get('filter'),
                    'sort' => $request->get('sort')])->links(),

                'items' => (string)view('admin.items.item-tr', compact('items', 'types'))
            ];


            return response($array);
        }


        return view('admin.items.index', compact('items', 'types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $types = ItemType::get();

        return view('admin.items.create', compact('types'));
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
        $this->validate($request, [
            'Name' => 'required',
            'MaxInStack' => 'required',
            'InventorySlotType' => 'required',
        ]);

        $itemData = $request->all();

        unset($itemData['Properties']);

        $item = Item::create($itemData);

        if (isset($request->Properties)) {

            $properties = $request->Properties;

            foreach ($properties as $property) {

                $itemProperty = new ItemProperty($property);
                $item->properties()->save($itemProperty);
            }
        }

        if ($request->ajax()) {

            return response(['status' => 'Item added!'], 200);
        }

        return redirect("items/$item->ID/edit")->with('status', 'Item added!');
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show(Request $request, $id)
    {
        $item = Item::where('ID', $id)->with('properties')->first();

        $properties = DB::table('item_properties')
            ->leftJoin('properties', 'item_properties.propertyID', '=', 'properties.ID')
            ->where('item_properties.itemID', $id)
            ->select('properties.name', 'properties.ID', 'item_properties.propertyValue as value')
            ->get();


        return view('admin.items.show', compact('item', 'properties'));
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
        $item = Item::where('ID', $id)->with('properties')->first();

        $properties = DB::table('item_properties')
            ->leftJoin('properties', 'item_properties.propertyID', '=', 'properties.ID')
            ->where('item_properties.itemID', $id)
            ->select('properties.name', 'properties.ID', 'item_properties.propertyValue as value')
            ->get();

        $types = ItemType::get();

        return view('admin.items.edit', compact('item', 'types', 'properties'));
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
        $this->validate($request, [
            'Name' => 'required',
            'MaxInStack' => 'required',
            'InventorySlotType' => 'required',
        ]);

        $itemData = $request->all();
        unset($itemData['Properties']);

        $item = Item::findOrFail($id);
        $item->update($itemData);

        ItemProperty::where('itemID', $id)->delete();

        if (isset($request->Properties)) {

            $properties = $request->Properties;

            foreach ($properties as $property) {

                $itemProperty = new ItemProperty($property);
                $item->properties()->save($itemProperty);
            }
        }

        if ($request->ajax()) {

            return response(['status' => 'Item updated!'], 200);
        }

        return redirect("items/$id/edit")->with('status', 'Item updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        Item::destroy($id);

        if ($request->ajax()) {

            return response(['status' => 'Item deleted!']);
        }

        return redirect(url()->previous())->with('status', 'Item deleted!');
    }

    public function properties(Request $request)
    {

        if (!isset($request->type) || $request->type == 1) {
            return '';
        }

        $properties = DB::table('item_type_properties')
            ->leftJoin('properties', 'item_type_properties.propertyID', '=', 'properties.ID')
            ->where('item_type_properties.InventorySlotType', $request->type)
            ->select('properties.name', 'properties.ID')
            ->get();

        return view('admin.items.property', compact('properties'));
    }

    protected function getTypes()
    {
        $types = ItemType::get();

        $array = [];

        foreach ($types as $type) {
            $array[$type->type] = $type->typeName;
        }

        return $array;
    }
}

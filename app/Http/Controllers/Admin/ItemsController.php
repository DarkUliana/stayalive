<?php

namespace App\Http\Controllers\Admin;

use App\CloudItem;
use App\Description;
use App\DiaryStorageNote;
use App\Equipment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Inventory;
use App\Item;
use App\ItemsInCraft;
use App\ItemType;
use App\LocalyticsItemType;
use App\LootCollectionItem;
use App\PlayerBodySlot;
use App\PlayerChestItems;
use App\PlayerRepairItemPart;
use App\PlayerRestorableObjectSlot;
use App\Property;
use App\RecipeComponents;
use App\RestorableObjectItem;
use App\RewardItem;
use App\ShopArticleItems;
use App\TechnologyItems;
use Illuminate\Http\Request;
use App\ItemProperty;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;

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

        $keyword = $request->search;
        $filter = $request->filter;

        $sort = $request->sort;

        $type = 'asc';
        if (isset($request->type)) {
            $type = $request->type;
        }
        $perPage = 25;

        $items = Item::where([]);

        if (isset($keyword)) {
            $items = $items->where('name', 'like', "%$keyword%");
        }
        if (isset($filter)) {
            $items = $items->where('itemType', $filter);
        }
        if (isset($sort)) {
            $items = $items->orderBy($sort, $type);
        }

        if (!isset($keyword) && !isset($filter) && !isset($sort)) {
            $items = $items->latest();
        }

        $items = $items->paginate($perPage);

        $slotTypes = $this->getSlotTypes();
        $itemTypes = $this->getItemTypes();

        if ($request->ajax()) {

            $array = [
                'pagination' => (string)$items->appends(['search' => $request->get('search'),
                    'filter' => $request->get('filter'),
                    'sort' => $request->get('sort')])->links(),

                'items' => (string)view('admin.items.item-tr', compact('items', 'slotTypes', 'itemTypes'))
            ];


            return response($array);
        }


        return view('admin.items.index', compact('items', 'slotTypes', 'itemTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $types = ItemType::get();
        $localyticsTypes = LocalyticsItemType::all();

        return view('admin.items.create', compact('types', 'localyticsTypes'));
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
            'itemType' => 'required',
        ]);

        $itemData = $request->all();

        unset($itemData['Properties']);
        unset($itemData['noteImage']);

        $item = Item::create($itemData);
        $properties = [];

        if (isset($request->Properties)) {

            $properties = $request->Properties;

            foreach ($properties as $property) {

                $itemProperty = new ItemProperty($property);
                $item->properties()->save($itemProperty);
            }
        }

        $this->updateNote($request, $properties);

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
        $localyticsTypes = LocalyticsItemType::all();
        $notes = [];

        if ($types->where('type', $item->InventorySlotType)->first()->typeName == 'Story') {

            $notes = DiaryStorageNote::all();

        }

        return view('admin.items.edit', compact('item', 'types', 'localyticsTypes', 'properties', 'notes'));
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
            'itemType' => 'required',
        ]);

        $itemData = $request->all();
        unset($itemData['Properties']);
        unset($itemData['noteImage']);

        $item = Item::findOrFail($id);
        $item->update($itemData);

        ItemProperty::where('itemID', $id)->delete();

        $properties = [];
        if (isset($request->Properties)) {

            $properties = $request->Properties;

            foreach ($properties as $property) {

                $itemProperty = new ItemProperty($property);
                $item->properties()->save($itemProperty);
            }
        }
        $this->updateNote($request, $properties);

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

        $item = Item::where('id', $id)->first();
        CloudItem::where('imageName', $item->Name)->delete();
        ShopArticleItems::where('imageName', $item->Name)->delete();
        Equipment::where('itemID', $id)->update(['itemID' => -1]);
        Inventory::where('itemID', $id)->update(['itemID' => -1]);
        ItemsInCraft::where('itemID', $id)->update(['itemID' => -1]);
        PlayerBodySlot::where('itemID', $id)->update(['itemID' => -1]);
        PlayerChestItems::where('itemID', $id)->update(['itemID' => -1]);
        PlayerRestorableObjectSlot::where('itemID', $id)->update(['itemID' => -1]);
        ItemProperty::where('itemID', $id)->delete();
        LootCollectionItem::where('itemID', $id)->delete();
        PlayerRepairItemPart::where('itemID', $id)->delete();
        RecipeComponents::where('itemID', $id)->delete();
        RewardItem::where('itemID', $id)->delete();
        TechnologyItems::where('itemID', $id)->delete();
        RestorableObjectItem::where('ItemID', $id)->delete();



        Item::destroy($id);

        if ($request->ajax()) {

            return response(['status' => 'Item deleted!']);
        }

        return redirect('items')->with('status', 'Item deleted!');
    }

    public function properties(Request $request)
    {

        if (!isset($request->type) || $request->type == 1) {
            return '';
        }
        $notes = [];

        $properties = DB::table('item_type_properties')
            ->leftJoin('properties', 'item_type_properties.propertyID', '=', 'properties.ID')
            ->where('item_type_properties.InventorySlotType', $request->type)
            ->select('properties.name', 'properties.ID')
            ->get();
        if (ItemType::where('type', $request->type)->value('typeName') == 'Story') {

            $notes = DiaryStorageNote::all();

        }


        return view('admin.items.property', compact('properties', 'notes'));
    }

    protected function getSlotTypes()
    {
        $types = ItemType::all();

        $array = [];

        foreach ($types as $type) {
            $array[$type->type] = $type->typeName;
        }

        return $array;
    }

    protected function getItemTypes()
    {
        $types = LocalyticsItemType::all();

        $array = [];

        foreach ($types as $type) {
            $array[$type->index] = $type->name;
        }

        return $array;
    }

    public function export()
    {
        $names = ['Name' => 0, 'Damage' => 1, 'Attack Speed' => 2, 'Armor' => 3, 'maxDurability' => 4, 'durabilityDecrement' => 5, 'movementSpeed' => 6];
        $items = DB::table('items')
            ->leftJoin('recipes', 'items.ID', '=', 'recipes.ItemID')
            ->select('items.ID')
            ->whereBetween('recipes.recipeType', [0, 4])


            ->orderBy('recipes.Level', 'ASC')
            ->orderBy('recipes.recipeType', 'ASC')
            ->orderBy('recipes.CraftTime', 'ASC')

            ->pluck('items.ID');

        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        $csv->insertOne(array_keys($names));

        foreach ($items as $item) {
            $csv->insertOne($this->toArrayForExport($item, $names));
        }

        $csv->output('items.csv');
    }

    protected function toArrayForExport($id, $names)
    {
        $array = [];

        $item = Item::find($id);

        $array[$names['Name']] = $item->Name;
        $array[$names['Damage']] =
        $array[$names['Attack Speed']] =
        $array[$names['Armor']] =
        $array[$names['maxDurability']] =
        $array[$names['durabilityDecrement']] =
        $array[$names['movementSpeed']] = "NULL";

        if($item->properties) {

            foreach ($item->properties as $property) {


                switch ($property->propertyName->name) {

                    case 'damage':
                        $array[$names['Damage']] = $property->propertyValue;
                        break;
                    case 'attackSpeed':
                        $array[$names['Attack Speed']] = $property->propertyValue;
                        break;
                    case 'armor':
                        $array[$names['Armor']] = $property->propertyValue;
                        break;
                    case 'maxDurability':
                        $array[$names['maxDurability']] = $property->propertyValue;
                        break;
                    case 'durabilityDecrement':
                        $array[$names['durabilityDecrement']] = $property->propertyValue;
                        break;
                    case 'movementSpeed':
                        $array[$names['movementSpeed']] = $property->propertyValue;
                        break;
                }
            }

        }

        ksort($array);

        return $array;
    }

    protected function updateNote(Request $request, $properties)
    {

        if (isset($request->noteImage) && !empty($properties)) {

            $noteID = $properties[0]['propertyValue'];

            DiaryStorageNote::where('noteID', $noteID)->update(['noteImage' => $request->noteImage]);
        }
    }
}

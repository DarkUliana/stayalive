<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;
use App\ItemProperty;
use App\Http\Resources\ItemCollection;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    protected $defaultProperties = [
        'Name', 'MaxInStack', 'InventorySlotType'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = new ItemCollection(Item::get());

        return response($items, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!isset($request->allItemsData)) {

            return response('Invalid data', 400);
        }

        ItemProperty::truncate();
        Item::truncate();

        $data = $this->getPropertiesForWrite($request->allItemsData);

        $counter = 0;
        foreach ($data as $value) {

            $item = Item::create($value['item']);

            $counter++;

            foreach ($value['properties'] as $property) {

                $itemProperty = new ItemProperty($property);
                $item->properties()->save($itemProperty);
            }
        }

        return response("$counter Items written", 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        return response(Item::destroy($item->Id), 204);
    }

    protected function getPropertiesForWrite($array)
    {
        $data = [];
        foreach ($array as $item) {


            $Json = json_decode($item['Json'], true);

            $data[$Json['Id']]['properties'] = [];
            foreach ($Json as $key => $value) {


                if (in_array($key, $this->defaultProperties)) { //щоб не писати значення які пишуться в таблицю items (ті, які є в батьківському класі BaseItemInfo)
                    $data[$Json['Id']]['item'][$key] = $value; //сортування по Id
                } else {
                    if ($key != 'Id') {    //щоб не писати Id в таблицю item_property
                        $data[$Json['Id']]['properties'][] = [
                            'propertyName' => $key,
                            'propertyValue' => (string)$value,
                            'propertyType' => gettype($value)
                        ];
                    }
                }
            }

            $data[$Json['Id']]['item']['Type'] = $item['Type'];
        }

        ksort($data);
        reset($data);
        return $data;
    }
}

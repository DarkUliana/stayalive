<?php

namespace App\Http\Controllers\Admin;

use App\AfterCraftItems;
use App\Equipment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Inventory;
use App\Item;
use App\ItemProperty;
use App\ItemsInCraft;
use App\Online;
use App\Player;
use App\PlayerBuildingTechnology;
use App\PlayerChestItems;
use App\PlayerTechnologiesStates;
use App\Timer;
use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\DB;

class PlayersController extends Controller
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
            $players = Player::where('Name', $keyword)->paginate($perPage);
        } else {
            $players = Player::latest()->paginate($perPage);
        }

        if ($request->ajax()) {

            $response = $this->playersOnline($players);
            return response($response, 200);
        }

        return view('admin.players.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.players.create');
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

        Player::create($requestData);

        return redirect('players')->with('flash_message', 'Player added!');
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
        $player = Player::findOrFail($id);
        $inventory = $this->getInventory(Inventory::where('googleID', $player->googleID)->get(), true);

        return view('admin.players.show', compact('player', 'inventory'));
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
        $player = Player::findOrFail($id);
        $inventory = $this->getInventory(Inventory::where('googleID', $player->googleID)->get());
        $items = Item::all();

        return view('admin.players.edit', compact('player', 'items', 'inventory'));
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

        $player = Player::findOrFail($id);
        $player->update($requestData);

        return redirect('players')->with('flash_message', 'Player updated!');
    }

    /**
     * Remove the specified resource from storage.
     * @param Request $request
     *
     * @param  int $id
     *
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $googleID = null)
    {

        if (isset($request->googleIDs)) {

            $count = 0;
            foreach ($request->googleIDs as $ID => $check) {

                if ($check == 'on') {

                    $this->delete($ID);
                }
                ++$count;
            }

            return redirect('players')->with('flash_message', "$count Players deleted!");
        }

        $this->delete($googleID);

        return response('ok', 200);
    }

    protected function playersOnline($players)
    {
        $arr = [];
        foreach ($players as $player) {

            if (!empty(Online::where('googleID', $player->googleID)->first())) {

                $online = Online::where('googleID', $player->googleID)->first()->online;
            } else {
                $online = 'false';
            }

            $arr[] = [
                'googleID' => $player->googleID,
                'online' => $online
            ];
        }
        return $arr;
    }

    protected function delete($googleID)
    {

        AfterCraftItems::where('googleID', $googleID)->delete();
        Equipment::where('googleID', $googleID)->delete();
        Inventory::where('googleID', $googleID)->delete();
        ItemsInCraft::where('googleID', $googleID)->delete();
        PlayerBuildingTechnology::where('googleID', $googleID)->delete();
        PlayerChestItems::where('googleID', $googleID)->delete();
        PlayerTechnologiesStates::where('googleID', $googleID)->delete();
        Timer::where('googleID', $googleID)->delete();
        Online::where('googleID', $googleID)->delete();

        Player::where('googleID', $googleID)->delete();
    }

    protected function getInventory($items, $forShow = false)
    {
        $array = [];

        foreach ($items as $item) {


            $temp = $item->toArray();

            if ($item->itemID == -1) {

                if ($forShow) {
                    continue;
                }

                $temp['name'] = '';
                $temp['maxInStack'] = 0;
                $temp['maxDurability'] = 0;

            } else {
                $property = ItemProperty::where('itemID', $item->itemID)->where('propertyID', 1)->first();

                if (!empty($property)) {

                    $temp['maxDurability'] = $property->propertyValue;
                } else {

                    $temp['maxDurability'] = 0;
                }

                $temp['name'] = $item->item->Name;
                $temp['maxInStack'] = $item->item->MaxInStack;


                if ($temp['currentDurability'] > $temp['maxDurability']) {
                    $temp['maxDurability'] = $temp['currentDurability'];
                }

            }
            $array[] = $temp;

        }

        if (!$forShow && empty($array)) {

            $array = $this->seedInventory();
        }

        return $array;
    }

    public function saveItems(Request $request)
    {

        foreach ($request->items as $item) {

            Inventory::where('googleID', $request->googleID)
                ->where('Index', $item['Index'])
                ->delete();

            Inventory::create(array_merge($item, ['googleID' => $request->googleID, 'available' => 1]));
        }
        return redirect('players')->with('flash_message', "Player items updated!");
    }

    protected function seedInventory()
    {
        $array = [];

        for ($i = 1; $i <= 10; ++$i) {
            $array[] = [
                'name' => '',
                'CurrentCount' => 0,
                'currentDurability' => 0,
                'maxInStack' => 0,
                'itemID' => -1,
                'maxDurability' => 0,
                'Index' => $i
            ];
        }

        return $array;
    }

    public function getItem(Request $request, $id)
    {

        if ($id == -1) {

            $item = [
                'ID' => $id,
                'MaxInStack' => 0,
                'maxDurability' => 0
            ];

            return response($item, 200);
        }

        $item = Item::find($id)->toArray();

        $maxDurability = DB::table('item_properties')
            ->leftJoin('properties', 'item_properties.propertyID', '=', 'properties.ID')
            ->where('item_properties.itemID', $id)
            ->where('properties.name', '=', 'maxDurability')
            ->value('item_properties.propertyValue');


        if ($maxDurability != null) {

            $item['maxDurability'] = $maxDurability;
        } else {

            $item['maxDurability'] = 0;
        }

        return response($item, 200);
    }
}

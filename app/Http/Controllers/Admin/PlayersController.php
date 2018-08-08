<?php

namespace App\Http\Controllers\Admin;

use App\AfterCraftItems;
use App\CloudItem;
use App\Equipment;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Inventory;
use App\Item;
use App\ItemsInCraft;
use App\Online;
use App\Player;
use App\PlayerBodyPosition;
use App\PlayerBodySlot;
use App\PlayerBuildingTechnology;
use App\PlayerChestItems;
use App\PlayerQuest;
use App\PlayerQuestReplacement;
use App\PlayerRestorableObject;
use App\PlayerRestorableObjectSlot;
use App\PlayerReward;
use App\PlayerTechnologiesStates;
use App\RestorableObject;
use App\Timer;
use Illuminate\Http\Request;

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
            $players = Player::where('Name', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $players = Player::latest()->paginate($perPage);
        }

        if ($request->ajax()) {

            $response = $this->playersOnline($players);
            return response($response, 200);
        }

        $count = Player::count();

        return view('admin.players.index', compact('players', 'count'));
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
        $types = [
            'GoldPurchase',
            'MoneyPurchase',
            'BoxOpen',
            'CraftItem',
            'Reward'
        ];
        $cloud = CloudItem::where('googleID', Player::where('ID', $id)->value('googleID'))->orderBy('sourceID')->get();

        return view('admin.players.show', compact('player', 'cloud', 'types'));
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
        $cloud = CloudItem::where('googleID', Player::where('ID', $id)->value('googleID'))->where('isTaken', 0)->get();
        $items = Item::all();

        return view('admin.players.edit', compact('player', 'items', 'cloud'));
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
//        CloudItem::where('googleID', $googleID)->delete();
        Equipment::where('googleID', $googleID)->delete();
        Inventory::where('googleID', $googleID)->delete();
        ItemsInCraft::where('googleID', $googleID)->delete();
        PlayerBuildingTechnology::where('googleID', $googleID)->delete();
        PlayerChestItems::where('googleID', $googleID)->delete();
        PlayerQuest::where('googleID', $googleID)->delete();
        PlayerTechnologiesStates::where('googleID', $googleID)->delete();
        Timer::where('googleID', $googleID)->delete();
        Online::where('googleID', $googleID)->delete();
        PlayerReward::where('googleID', $googleID)->delete();
        PlayerBodySlot::where('googleID', $googleID)->delete();
        PlayerBodyPosition::where('googleID', $googleID)->delete();
        PlayerRestorableObject::where('googleID', $googleID)->delete();
        PlayerQuestReplacement::where('googleID', $googleID)->delete();

        Player::where('googleID', $googleID)->delete();
    }

    public function saveItems(Request $request)
    {

        CloudItem::where('googleID', $request->googleID)
            ->where('isTaken', 0)
            ->delete();

        foreach ($request->items as $item) {

            $properties = [
                'googleID' => $request->googleID,
                'sourceID' => 4, 'isTaken' => 0,
                'uniqueID' => uniqid('id', true),
                'inStuck' => (Item::where('Name', $item['imageName'])->value('maxInStack')) == 1 ? 0 : 1
            ];

            CloudItem::create(array_merge($item, $properties));
        }
        return redirect('players')->with('flash_message', "Player items updated!");
    }

    public function getItem(Request $request, $id)
    {

        if ($id == -1) {

            $item = [
                'ID' => $id,
                'Name' => '',
                'MaxInStack' => 0,
                'maxDurability' => 0
            ];

            return response($item, 200);
        }

        $item = Item::where('Name', $id)->first()->toArray();

        return response($item, 200);
    }

    public function getCloudItem(Request $request)
    {
        if (!isset($request->counter)) {

            return response('Invalid data!', 400);
        }

        $counter = $request->counter + 1;
        $items = Item::all();
        $firstItem = Item::where([])->first();

        return view('admin.players.slot', compact('counter', 'items', 'firstItem'));
    }

    public function deleteAll()
    {
        AfterCraftItems::truncate();
        CloudItem::truncate();
        Equipment::truncate();
        Inventory::truncate();
        ItemsInCraft::truncate();
        PlayerBuildingTechnology::truncate();
        PlayerChestItems::truncate();
        PlayerQuest::truncate();
        PlayerTechnologiesStates::truncate();
        Timer::truncate();
        Online::truncate();
        PlayerReward::truncate();
        PlayerBodySlot::truncate();
        PlayerBodyPosition::truncate();
        PlayerRestorableObject::truncate();
        PlayerRestorableObjectSlot::truncate();
        PlayerQuestReplacement::truncate();

        Player::truncate();

        return response('ok', 200);
    }
}

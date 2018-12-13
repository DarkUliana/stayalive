<?php

namespace App\Http\Controllers\Admin;

use App\BanList;
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
use App\PlayerDiaryNote;
use App\PlayerIdentificator;
use App\PlayerLearnedRecipe;
use App\PlayerPrefRecord;
use App\PlayerQuest;
use App\PlayerQuestReplacement;
use App\PlayerRepairItem;
use App\PlayerRepairItemPart;
use App\PlayerRestorableObject;
use App\PlayerRestorableObjectSlot;
use App\PlayerReward;
use App\PlayerSequence;
use App\PlayerShipStuffItem;
use App\PlayerTechnologiesStates;
use App\PlayerTechnologyQuantity;
use App\PlayerTraveledIsland;
use App\PlayerSceneChest;
use App\RestorableObject;
use App\Reward;
use App\Timer;
use App\TutorialSaveData;
use Carbon\Carbon;
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
        session(['itemsParams' => $request->getQueryString()]);

        $keyword = $request->get('search');
        $perPage = 50;

        if (!empty($keyword)) {
            $players = Player::where('Name', 'LIKE', "%$keyword%")
                ->orWhere('googleID', 'LIKE', "%$keyword%")
                ->orWhereIn('ID', PlayerIdentificator::where('localID', 'LIKE', "%$keyword%")->pluck('playerID')->toArray())
                ->paginate($perPage);

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

        return redirect('players' . getQueryParams(request()))->with('flash_message', 'Player added!');
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
        $cloud = CloudItem::where('playerID', $id)->where('isTaken', 0)->get();
        $items = Item::all();
        $rewards = Reward::all();

        return view('admin.players.edit', compact('player', 'items', 'rewards', 'cloud'));
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

        if (!isset($request['isDeveloper'])) {

            $requestData['isDeveloper'] = 0;
        }

        $player = Player::findOrFail($id);
        $player->update($requestData);

        if ($request->ajax()) {

            return response('ok', 200);
        }
        return redirect('players' . getQueryParams(request()))->with('flash_message', 'Player updated!');
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
    public function destroy(Request $request, $localID = null)
    {

        if (isset($request->localIDs)) {
            
            foreach ($request->localIDs as $id) {

                $this->delete($id);
            }

            return response('ok', 200);
        }

        $this->delete($localID);

        return response('ok', 200);
    }

    protected function playersOnline($players)
    {
        $arr = [];
        foreach ($players as $player) {

            if (!empty(Online::where('playerID', $player->ID)->first())) {

                $online = Online::where('playerID', $player->ID)->first()->online;
            } else {
                $online = 'false';
            }

            $arr['players'][] = [
                'playerID' => $player->ID,
                'online' => $online
            ];
        }

        $arr['online'] = Online::where('updated_at', '>', date('Y-m-d H:i:s', time()-30))->count();
        return $arr;
    }

    public function delete($playerID)
    {
        
        Equipment::where('playerID', $playerID)->delete();
        Inventory::where('playerID', $playerID)->delete();
        ItemsInCraft::where('playerID', $playerID)->delete();
        PlayerBuildingTechnology::where('playerID', $playerID)->delete();
        PlayerChestItems::where('playerID', $playerID)->delete();
        PlayerQuest::where('playerID', $playerID)->delete();
        PlayerTechnologiesStates::where('playerID', $playerID)->delete();
        Timer::where('playerID', $playerID)->delete();
        Online::where('playerID', $playerID)->delete();
        PlayerReward::where('playerID', $playerID)->delete();
        PlayerBodySlot::where('playerID', $playerID)->delete();
        PlayerBodyPosition::where('playerID', $playerID)->delete();

        $objects = PlayerRestorableObject::where('playerID', $playerID)->get();
        foreach ($objects as $object) {

            PlayerRestorableObjectSlot::where('restorableObjectID', $object->ID)->delete();
        }
        PlayerRestorableObject::where('playerID', $playerID)->delete();

        PlayerQuestReplacement::where('playerID', $playerID)->delete();
        PlayerLearnedRecipe::where('playerID', $playerID)->delete();
        PlayerShipStuffItem::where('playerID', $playerID)->delete();

        $items = PlayerRepairItem::where('playerID', $playerID)->get();
        foreach ($items as $item) {

            PlayerRepairItemPart::where('repairItemID', $item->ID)->delete();
        }
        PlayerRepairItem::where('playerID', $playerID)->delete();

        PlayerDiaryNote::where('playerID', $playerID)->delete();
        PlayerPrefRecord::where('playerID', $playerID)->delete();
        PlayerSequence::where('playerID', $playerID)->delete();
        PlayerTechnologyQuantity::where('playerID', $playerID)->delete();
        PlayerTraveledIsland::where('playerID', $playerID)->delete();
        PlayerIdentificator::where('playerID', $playerID)->delete();
        TutorialSaveData::where('playerID', $playerID)->delete();
        PlayerSceneChest::where('playerID', $playerID)->delete();
        BanList::where('playerID', $playerID)->delete();
        Player::where('ID', $playerID)->delete();

    }

    public function saveItems(Request $request)
    {

        $rewards = Reward::pluck('name')->toArray();

        CloudItem::where('playerID', $request->playerID)
            ->where('isTaken', 0)
            ->delete();

        if (isset($request->items)) {

            foreach ($request->items as $item) {

                $properties = [
                    'playerID' => $request->playerID,
                    'sourceID' => 4, 'isTaken' => 0,
                    'uniqueID' => uniqid('id', true),
                    'inStuck' => (Item::where('Name', $item['imageName'])->value('maxInStack')) == 1 ? 0 : 1
                ];

                if (in_array($item['imageName'], $rewards)) {

                    $properties['sourceID'] = 5;
                }

                CloudItem::create(array_merge($item, $properties));
            }
        }

        return redirect('players' . getQueryParams(request()))->with('flash_message', "Player items updated!");
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

        $item = Item::where('Name', $id)->first();

        if (!$item) {

            $item['MaxInStack'] = 1;
        }

        return response($item, 200);
    }

    public function getCloudItem(Request $request)
    {
        if (!isset($request->counter)) {

            return response('Invalid data!', 400);
        }

        $counter = $request->counter + 1;
        $items = Item::all();
        $firstItem = $items->first();
        $rewards = Reward::all();

        return view('admin.players.slot', compact('counter', 'items', 'rewards', 'firstItem'));
    }

    public function deleteAll()
    {
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
        PlayerLearnedRecipe::truncate();
        PlayerShipStuffItem::truncate();
        PlayerRepairItem::truncate();
        PlayerRepairItemPart::truncate();
        PlayerDiaryNote::truncate();
        PlayerPrefRecord::truncate();
        PlayerSequence::truncate();
        PlayerTechnologyQuantity::truncate();
        PlayerTraveledIsland::truncate();
        TutorialSaveData::truncate();
        PlayerSceneChest::truncate();
        BanList::truncate();
        PlayerIdentificator::truncate();
        Player::truncate();

        return response('ok', 200);
    }
}

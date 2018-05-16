<?php

namespace App\Http\Controllers\Admin;

use App\AfterCraftItems;
use App\Equipment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Inventory;
use App\Item;
use App\ItemsInCraft;
use App\Online;
use App\Player;
use App\PlayerBuildingTechnology;
use App\PlayerChestItems;
use App\PlayerTechnologiesStates;
use App\Timer;
use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;

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

        return view('admin.players.show', compact('player'));
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
        $inventory = Inventory::where('googleID', $id)->get();
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
//        var_dump($googleID); die();
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
}

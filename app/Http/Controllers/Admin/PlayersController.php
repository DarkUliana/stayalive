<?php

namespace App\Http\Controllers\Admin;

use App\AfterCraftItems;
use App\Equipment;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Inventory;
use App\ItemsInCraft;
use App\Online;
use App\Player;
use App\PlayerBuildingTechnology;
use App\PlayerChestItems;
use App\PlayerTechnologiesStates;
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
            $players = Player::latest()->paginate($perPage);
        } else {
            $players = Player::latest()->paginate($perPage);
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
     * @param  int  $id
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
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $player = Player::findOrFail($id);

        return view('admin.players.edit', compact('player'));
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
        
        $requestData = $request->all();
        
        $player = Player::findOrFail($id);
        $player->update($requestData);

        return redirect('players')->with('flash_message', 'Player updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($googleID)
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


        return redirect('players')->with('flash_message', 'Player deleted!');
    }
}

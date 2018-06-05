<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item;
use App\Reward;
use App\RewardChestType;
use App\RewardItem;
use Illuminate\Http\Request;

class RewardsController extends Controller
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
            $rewards = Reward::latest()->paginate($perPage);
        } else {
            $rewards = Reward::latest()->paginate($perPage);
        }



        return view('admin.rewards.index', compact('rewards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $chests = RewardChestType::all();
        $items = Item::all();

        return view('admin.rewards.create', compact('chests', 'items'));
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
        
        Reward::create($requestData);

        return redirect('rewards')->with('flash_message', 'Reward added!');
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
        $reward = Reward::findOrFail($id);
        $components = RewardItem::where('rewardID', $id)->get();

        return view('admin.rewards.show', compact('reward', 'components'));
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
        $reward = Reward::findOrFail($id);
        $chests = RewardChestType::all();
        $items = Item::all();
        $components = RewardItem::where('rewardID', $id)->get();

        return view('admin.rewards.edit', compact('reward', 'chests', 'items', 'components'));
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
        
        $reward = Reward::findOrFail($id);
        $reward->update($requestData);

        return redirect('rewards')->with('flash_message', 'Reward updated!');
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
        Reward::destroy($id);

        return redirect('rewards')->with('flash_message', 'Reward deleted!');
    }

    public function item(Request $request)
    {
        $counter = $request->counter+1;
        $items = Item::all();

        return view('admin.rewards.item', compact('items', 'counter'));
    }
}

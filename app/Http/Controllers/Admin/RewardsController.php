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
    protected $validationArray = [
        'name' => 'required|string',
        'chest' => 'required|integer',
        'components' => 'required|array',
        'components.*.itemID' => 'required|integer',
        'components.*.count' => 'required|integer',
        'components.*.rarity' => 'required|integer'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        session(['itemsParams' => $request->getQueryString()]);

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $rewards = Reward::where('name', 'LIKE', "%$keyword%")->paginate($perPage);
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
        $this->validate($request, $this->validationArray);

        $requestData = $request->all();
        $components = $requestData['components'];
        unset($requestData['components']);
        
        $reward = Reward::create($requestData);

        foreach ($components as $component) {

            $item = new RewardItem($component);
            $reward->rewardList()->save($item);
        }

        return redirect('rewards' . getQueryParams(request()))->with('flash_message', 'Reward added!');
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
        $this->validate($request, $this->validationArray);
        
        $requestData = $request->all();
        $components = $requestData['components'];
        unset($requestData['components']);
        
        $reward = Reward::findOrFail($id);
        $reward->update($requestData);

        RewardItem::where('rewardID', $id)->delete();

        foreach ($components as $component) {

            $item = new RewardItem($component);
            $reward->rewardList()->save($item);
        }

        return redirect('rewards' . getQueryParams(request()))->with('flash_message', 'Reward updated!');
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
        RewardItem::where('rewardID', $id)->delete();
        Reward::destroy($id);

        return redirect('rewards' . getQueryParams(request()))->with('flash_message', 'Reward deleted!');
    }

    public function item(Request $request)
    {
        $counter = $request->counter+1;
        $items = Item::all();

        return view('admin.rewards.item', compact('items', 'counter'));
    }
}

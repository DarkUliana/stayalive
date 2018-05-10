<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Quest;
use App\Reward;
use App\RewardType;
use Illuminate\Http\Request;

class QuestsController extends Controller
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
            $quests = Quest::where('name', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $quests = Quest::latest()->paginate($perPage);
        }

        return view('admin.quests.index', compact('quests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $rewards = Reward::all();
        $types = RewardType::all();

        return view('admin.quests.create', compact('rewards', 'types'));
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
        
        Quest::create($requestData);

        return redirect('quests')->with('flash_message', 'Quest added!');
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
        $quest = Quest::findOrFail($id);

        return view('admin.quests.show', compact('quest'));
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
        $quest = Quest::findOrFail($id);
        $rewards = Reward::all();
        $types = RewardType::all();

        return view('admin.quests.edit', compact('quest', 'rewards', 'types'));
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
        
        $quest = Quest::findOrFail($id);
        $quest->update($requestData);

        return redirect('quests')->with('flash_message', 'Quest updated!');
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
        Quest::destroy($id);

        return redirect('quests')->with('flash_message', 'Quest deleted!');
    }
}

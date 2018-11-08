<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BanList;
use App\Player;
use Illuminate\Http\Request;

class BanListController extends Controller
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
            $banlist = BanList::latest()->paginate($perPage);
        } else {
            $banlist = BanList::latest()->paginate($perPage);
        }

        $players = Player::all();
        $view = view('admin.ban-list.index', compact('banlist', 'players'));

        BanList::where('status', 0)->update(['status' => 1]);

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.ban-list.create');
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

        if (!BanList::where('playerID', $request->playerID)) {

            BanList::create($requestData);
        }

        return redirect('ban-list')->with('flash_message', 'Player added!');
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
        $banlist = BanList::findOrFail($id);

        return view('admin.ban-list.show', compact('banlist'));
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
        $banlist = BanList::findOrFail($id);

        return view('admin.ban-list.edit', compact('banlist'));
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

        $banlist = BanList::findOrFail($id);
        $banlist->update($requestData);

        return redirect('ban-list')->with('flash_message', 'BanList updated!');
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
        BanList::destroy($id);

        return redirect('ban-list')->with('flash_message', 'Player deleted!');
    }
}

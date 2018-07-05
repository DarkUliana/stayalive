<?php

namespace App\Http\Controllers\Admin;

use App\Enemy;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Mob;
use Illuminate\Http\Request;

class MobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
//        $keyword = $request->get('search');
        $sort = $request->get('sort');
        $perPage = 25;

        $type = 'asc';
        if (!empty ($request->get('type'))) {
            $type = $request->get('type');
        }

//        if (!empty($keyword)) {
//            $mobs = Mob::latest()->paginate($perPage);
//        } else {


//        $mobs = Mob::latest()->paginate($perPage);
//        }

        if (!empty($sort)) {

            $mobs = Mob::orderBy($sort, $type)->paginate($perPage);
        }
        else {

            $mobs = Mob::latest()->paginate($perPage);
        }

        return view('admin.mobs.index', compact('mobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $enemies = Enemy::all();
        return view('admin.mobs.create', compact('enemies'));
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

        Mob::create($requestData);

        return redirect('mobs')->with('flash_message', 'Mob added!');
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
        $mob = Mob::findOrFail($id);

        return view('admin.mobs.show', compact('mob'));
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
        $mob = Mob::findOrFail($id);
        $enemies = Enemy::all();

        return view('admin.mobs.edit', compact('mob', 'enemies'));
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

        $mob = Mob::findOrFail($id);
        $mob->update($requestData);

        return redirect('mobs')->with('flash_message', 'Mob updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Mob::destroy($id);

        return redirect('mobs')->with('flash_message', 'Mob deleted!');
    }
}

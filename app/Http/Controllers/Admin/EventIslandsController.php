<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\EventIsland;
use Illuminate\Http\Request;

class EventIslandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $eventIslands = EventIsland::latest()->paginate($perPage);
        } else {
            $eventIslands = EventIsland::latest()->paginate($perPage);
        }

        return view('admin.event-islands.index', compact('eventIslands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.event-islands.create');
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
        
        EventIsland::create($requestData);

        return redirect('event-islands')->with('flash_message', 'EventIsland added!');
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
        $eventIsland = EventIsland::findOrFail($id);

        return view('admin.event-islands.show', compact('eventIsland'));
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
        $eventIsland = EventIsland::findOrFail($id);

        return view('admin.event-islands.edit', compact('eventIsland'));
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
        
        $eventIsland = EventIsland::findOrFail($id);
        $eventIsland->update($requestData);

        return redirect('event-islands')->with('flash_message', 'EventIsland updated!');
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
        EventIsland::destroy($id);

        return redirect('event-islands')->with('flash_message', 'EventIsland deleted!');
    }
}

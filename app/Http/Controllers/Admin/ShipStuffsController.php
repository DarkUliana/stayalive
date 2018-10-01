<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ShipStuff;
use Illuminate\Http\Request;

class ShipStuffsController extends Controller
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
            $shipstuffs = ShipStuff::latest()->paginate($perPage);
        } else {
            $shipstuffs = ShipStuff::latest()->paginate($perPage);
        }

        return view('admin.ship-stuffs.index', compact('shipstuffs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.ship-stuffs.create');
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
        
        ShipStuff::create($requestData);

        return redirect('ship-stuffs')->with('flash_message', 'ShipStuff added!');
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
        $shipstuff = ShipStuff::findOrFail($id);

        return view('admin.ship-stuffs.show', compact('shipstuff'));
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
        $shipstuff = ShipStuff::findOrFail($id);

        return view('admin.ship-stuffs.edit', compact('shipstuff'));
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
        
        $shipstuff = ShipStuff::findOrFail($id);
        $shipstuff->update($requestData);

        return redirect('ship-stuffs')->with('flash_message', 'ShipStuff updated!');
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
        ShipStuff::destroy($id);

        return redirect('ship-stuffs')->with('flash_message', 'ShipStuff deleted!');
    }
}

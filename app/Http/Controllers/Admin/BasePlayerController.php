<?php

namespace App\Http\Controllers\Admin;

use App\BasePlayer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Version;
use Illuminate\Http\Request;

class BasePlayerController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $properties = BasePlayer::all();

        return view('admin.base-player.show', compact('properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        var_dump($request->input()); die();

        return redirect('base-player')->with('flash_message', 'Version updated!');
    }
}

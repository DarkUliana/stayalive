<?php

namespace App\Http\Controllers\Admin;

use App\BasePlayer;
use App\Http\Controllers\Controller;
use App\Http\Requests;
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
        $data = $request->all();
        unset($data['_token']);

        foreach ($data as $key => $value) {

            $property = BasePlayer::where('property', $key)->first();

            if ($property) {

                $property->value = $value;
                $property->save();
            }

        }

        return redirect('base-player')->with('status', 'Base Player Updated!');
    }
}

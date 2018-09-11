<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TechcoinSetting;
use Illuminate\Http\Request;

class TechcoinSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

            $techcoinsetting = TechcoinSetting::all();


        return view('admin.techcoin-settings.index', compact('techcoinsetting'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        
        foreach ($request->settings as $ID => $value) {

            TechcoinSetting::where('ID', $ID)->update(['value' => $value]);
        }

        return redirect('techcoin-settings')->with('flash_message', 'TechcoinSetting updated!');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\QuestReplacementTime;
use Illuminate\Http\Request;

class QuestReplacementTimesController extends Controller
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
            $questReplacementTimes = QuestReplacementTime::latest()->paginate($perPage);
        } else {
            $questReplacementTimes = QuestReplacementTime::orderBy('time')->paginate($perPage);
        }

        return view('admin.quest-replacement-times.index', compact('questReplacementTimes'));
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
        
        QuestReplacementTime::create($requestData);

        return redirect('quest-replacement-times')->with('flash_message', 'QuestReplacementTime added!');
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
        QuestReplacementTime::destroy($id);

        return redirect('quest-replacement-times')->with('flash_message', 'QuestReplacementTime deleted!');
    }
}

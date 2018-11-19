<?php

namespace App\Http\Controllers\Admin;

use App\DescriptionMode;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Quest;
use App\QuestDescription;
use Illuminate\Http\Request;

class QuestDescriptionsController extends Controller
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
            $questdescriptions = QuestDescription::latest()->paginate($perPage);
        } else {
            $questdescriptions = QuestDescription::latest()->paginate($perPage);
        }

        return view('admin.quest-descriptions.index', compact('questdescriptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $quests = Quest::all();
        $modes = DescriptionMode::all();

        return view('admin.quest-descriptions.create', compact('quests', 'modes'));
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
        
        QuestDescription::create($requestData);

        return redirect('quest-descriptions')->with('flash_message', 'QuestDescription added!');
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
        $questdescription = QuestDescription::findOrFail($id);

        return view('admin.quest-descriptions.show', compact('questdescription'));
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
        $questdescription = QuestDescription::findOrFail($id);
        $quests = Quest::all();
        $modes = DescriptionMode::all();

        return view('admin.quest-descriptions.edit', compact('questdescription', 'quests', 'modes'));
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
        
        $questdescription = QuestDescription::findOrFail($id);
        $questdescription->update($requestData);

        return redirect('quest-descriptions')->with('flash_message', 'QuestDescription updated!');
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
        QuestDescription::destroy($id);

        return redirect('quest-descriptions')->with('flash_message', 'QuestDescription deleted!');
    }
}

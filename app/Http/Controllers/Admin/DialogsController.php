<?php

namespace App\Http\Controllers\Admin;

use App\Description;
use App\DialogDescription;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Dialog;
use App\Quest;
use Illuminate\Http\Request;

class DialogsController extends Controller
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
            $dialogs = Dialog::latest()->paginate($perPage);
        } else {
            $dialogs = Dialog::latest()->paginate($perPage);
        }

        return view('admin.dialogs.index', compact('dialogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $quests = Quest::all();
        $descriptions = Description::all();

        return view('admin.dialogs.create', compact('quests', 'descriptions'));
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

        $dialogData = $request->all();
        $descriptions = $request->descriptions;

        unset($dialogData['descriptions']);

        $this->createDialog($dialogData, $descriptions);

        return redirect('dialogs')->with('flash_message', 'Dialog added!');
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
        $dialog = Dialog::findOrFail($id);

        return view('admin.dialogs.show', compact('dialog'));
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
        $dialog = Dialog::findOrFail($id);
        $quests = Quest::all();
        $descriptions = Description::all();

        return view('admin.dialogs.edit', compact('dialog', 'quests', 'descriptions'));
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
        $dialogData = $request->all();
        $descriptions = $request->descriptions;

        unset($dialogData['descriptions']);

        $this->updateDialog($id, $dialogData, $descriptions);

        return redirect('dialogs')->with('flash_message', 'Dialog updated!');
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
        DialogDescription::where('dialogID', $id)->delete();
        Dialog::destroy($id);

        return redirect('dialogs')->with('flash_message', 'Dialog deleted!');
    }

    public function description(Request $request)
    {
        $descriptions = Description::all();
        $index = $request->index+1;

        return view('admin.dialogs.description', compact('descriptions', 'index'));
    }

    public function updateDialog($id, $dialogData, $descriptions)
    {
        $dialog = Dialog::findOrFail($id);
        $dialog->update($dialogData);

        DialogDescription::where('dialogID', $id)->delete();

        $this->storeDescriptions($descriptions, $dialog);
    }

    public function createDialog($dialogData, $descriptions)
    {
        $dialog = Dialog::create($dialogData);
        $this->storeDescriptions($descriptions, $dialog);
    }

    public function storeDescriptions($descriptions, $dialog)
    {
        foreach ($descriptions as $description) {

            $descriptionObj = new DialogDescription($description);
            $dialog->descriptions()->save($descriptionObj);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\AdditionalQuestsField;
use App\Enemy;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item;
use App\Quest;
use App\QuestField;
use App\QuestType;
use App\Reward;
use App\RewardChestType;
use App\Technology;
use Illuminate\Http\Request;

class QuestsController extends Controller
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
            $quests = Quest::where('name', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $quests = Quest::latest()->paginate($perPage);
        }

        return view('admin.quests.index', compact('quests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $rewards = Reward::all();
        $types = QuestType::all();
        $items = Item::all();
        $field = AdditionalQuestsField::where('name', 'itemID')->first();

        return view('admin.quests.create', compact('rewards', 'types', 'items', 'field'));
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
        $field = $requestData['field'];
        unset($requestData['field']);

        $quest = Quest::create($requestData);
        $fieldObj = new QuestField($field);
        $quest->field()->save($fieldObj);

        return redirect('quests')->with('flash_message', 'Quest added!');
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
        $quest = Quest::findOrFail($id);
        $field = [];
        switch ($quest->field->fieldName->name) {
            case('itemID'):

                $field['name'] = $quest->field->item->Name;
                $field['count'] = $quest->countToDo;
                break;

            case('technologyID'):
                $field['name'] = $quest->field->technology->name;
                $field['count'] = $quest->countToDo;
                break;

            case('enemy'):

                $field['name'] = $quest->field->enemy->name;
                $field['count'] = $quest->countToDo;
                break;
        }

        return view('admin.quests.show', compact('quest', 'field'));
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
        $quest = Quest::findOrFail($id);
        $rewards = Reward::all();
        $types = QuestType::all();

        $items = $this->getItems($quest->field->fieldName->name);

        return view('admin.quests.edit', compact('quest', 'rewards', 'types', 'items'));
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
        $field = $requestData['field'];
        unset($requestData['field']);

        $quest = Quest::findOrFail($id);
        $quest->update($requestData);

        QuestField::where('questID', $id)->delete();

        $fieldObj = new QuestField($field);
        $quest->field()->save($fieldObj);

        return redirect('quests')->with('flash_message', 'Quest updated!');
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
        QuestField::where('questID', $id)->delete();
        Quest::destroy($id);

        return redirect('quests')->with('flash_message', 'Quest deleted!');
    }

    public function items(Request $request)
    {
        if (!isset($request->type)) {
            return '';
        }

        $type = QuestType::find($request->type)->field->fieldName;
        $items = $items = $this->getItems($type->name);
        $name = ucfirst($type->name);
        $ID = $type->ID;

        return view('admin.quests.item', compact('ID', 'name', 'items'));
    }

    protected function getItems($type)
    {
        $items = [];
        switch ($type) {
            case('itemID'):
                $items = Item::all();
                break;
            case('technologyID'):
                $items = Technology::all();
                break;
            case('enemy'):
                $items = Enemy::all();
                break;
        }

        return $items;
    }
}

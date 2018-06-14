<?php

namespace App\Http\Controllers\Admin;

use App\AdditionalQuestsField;
use App\Description;
use App\Dialog;
use App\DialogDescription;
use App\Enemy;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Item;
use App\Quest;
use App\QuestField;
use App\QuestType;
use App\Reward;
use App\RewardChestType;
use App\Speaker;
use App\Technology;
use Illuminate\Http\Request;
use GuzzleHttp\Client as HttpClient;

class QuestsController extends Controller
{
    public $validateArray = [

        'name' => 'required|string',
        'daily' => 'required|in:0,1',
        'typeID' => 'required|integer',
        'countToDo' => 'required|integer',
        'level' => 'required|integer',
        'starPoints' => 'required|integer',
        'rewardID' => 'required|integer',
//        'descriptions.*.number' => 'required|integer',
//        'descriptions.*.descriptionID' => 'required|integer',
//        'descriptions.*.speaker' => 'required|integer'

    ];

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
        $descriptions = Description::all();

        return view('admin.quests.create', compact('rewards', 'types', 'items', 'field', 'descriptions'));
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
        $this->validate($request, $this->validateArray);

        $requestData = $request->all();
        unset($requestData['field']);
        unset($requestData['beginDescriptions']);
        unset($requestData['additionalDescriptions']);

        $quest = Quest::create($requestData);

        if (isset($request->field)) {

            $field = $request->field;

            $fieldObj = new QuestField($field);
            $quest->field()->save($fieldObj);
        }

        if ($request->daily == '0' && isset($request->beginDescriptions)) {

            $dialogData = [
                'name' => $request->name,
                'questID' => $quest->ID,
            ];

            $dialogsController = new DialogsController();

            $dialogsController->createDialog($dialogData, $request->beginDescriptions);

            if (isset($request->additionalDescriptions)) {

                $dialogData['type'] = 'additional';
                $dialogsController->createDialog($dialogData, $request->additionalDescriptions);
            }
        }

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

        if (isset($quest->field)) {

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
        $beginDialog = Dialog::where('questID', $id)->where('type', 'begin')->first();
        $additionalDialog = Dialog::where('questID', $id)->where('type', 'additional')->first();
        $descriptions = Description::all();

        if (isset($quest->field)) {
            $items = $this->getItems($quest->field->fieldName->name);
        }

        return view('admin.quests.edit', compact('quest', 'rewards', 'types', 'items', 'beginDialog',
            'additionalDialog', 'descriptions'));
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

        $this->validate($request, $this->validateArray);

        $requestData = $request->all();
        unset($requestData['field']);
        unset($requestData['beginDescriptions']);
        unset($requestData['additionalDescriptions']);

        $quest = Quest::findOrFail($id);
        $quest->update($requestData);

        QuestField::where('questID', $id)->delete();

        if (isset($request->field)) {

            $field = $request->field;

            $fieldObj = new QuestField($field);
            $quest->field()->save($fieldObj);
        }

        if ($request->daily == '0' && isset($request->beginDescriptions)) {

            $dialogData = [
                'name' => $request->name,
                'questID' => $id,
            ];

            $dialog = Dialog::where($dialogData)->where('type', 'begin')->first();

            $this->updateOrCreateDialog($dialog, $dialogData, $request->beginDescriptions);

            if (isset($request->additionalDescriptions)) {

                $dialog = Dialog::where($dialogData)->where('type', 'additional')->first();
                $dialogData['type'] = 'additional';
                $this->updateOrCreateDialog($dialog, $dialogData, $request->additionalDescriptions);

            } else {

                $dialog = Dialog::where('questID', $id)->where('type', 'additional')->first();
                DialogDescription::where('dialogID', $dialog->ID)->delete();
                $dialog->delete();
            }

        } else {

            $dialogs = Dialog::where('questID', $id)->pluck('ID');
            DialogDescription::whereIn('dialogID', $dialogs)->delete();
            Dialog::whereIn('ID', $dialogs)->delete();
        }

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
        $dialog = Dialog::where('questID', $id)->first();
        DialogDescription::where('dialogID', $dialog->ID)->delete();
        $dialog->delete();

        return redirect('quests')->with('flash_message', 'Quest deleted!');
    }

    public function items(Request $request)
    {
        if (!isset($request->type)) {
            return '';
        }

        $questType = QuestType::find($request->type);
        if (!isset($questType->field)) {
            return '';
        }

        $type = $questType->field->fieldName;
        $items = $items = $this->getItems($type->name);
        $name = ucfirst($type->name);
        $ID = $type->ID;
        $inputType = $type->type;

        return view('admin.quests.item', compact('ID', 'name', 'items', 'inputType'));
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
            case('speaker'):
                $items = Speaker::all();
                break;
        }

        return $items;
    }

    protected function updateOrCreateDialog($dialog, $dialogData, $descriptions)
    {
        $dialogsController = new DialogsController();

        if ($dialog) {

            $dialogsController->updateDialog($dialog->ID, $dialogData, $descriptions);

        } else {

            $dialogsController->createDialog($dialogData, $descriptions);
        }
    }


}

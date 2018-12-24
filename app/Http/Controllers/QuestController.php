<?php

namespace App\Http\Controllers;

use App\AdditionalQuestsField;
use App\Dialog;
use App\DialogDescription;
use App\Http\Resources\QuestCollection;
use App\Quest;
use App\QuestField;
use App\QuestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestController extends Controller
{

    public function getPlot()
    {
        $quests = new QuestCollection(Quest::where('daily', 0)->get());

        return response($quests, 200);
    }

    public function getOldPlot()
    {
        $quests = new QuestCollection(Quest::where('daily', 0)->where('typeID', '!=', 9)->get());

        return response($quests, 200);
    }

    public function getDaily()
    {
        $quests = new QuestCollection(Quest::where('daily', 1)->get());

        return response($quests, 200);
    }

    public function storePlot(Request $request)
    {
        if (!isset($request->allQuestsData)) {

            return response('Invalid data', 400);
        }

        $counter = $this->store($request, 0);

        return response("$counter Quests written", 201);

    }

    public function storeDaily(Request $request)
    {
        if (!isset($request->allQuestsData)) {

            return response('Invalid data', 400);
        }

        $counter = $this->store($request, 1);

        return response("$counter Quests written", 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param integer $daily
     * @return \int
     */
    public function store(Request $request, $daily = 1)
    {


        $quests = Quest::where('daily', $daily)->pluck('ID');
        Quest::where('daily', $daily)->delete();
        QuestField::whereIn('questID', $quests);

        foreach ($quests as $questID) {

            $dialog = Dialog::where('questID', $questID)->first();
            DialogDescription::where('dialogID', $dialog->ID)->delete();
            $dialog->delete();
        }


        $data = $this->getQuestsForWrite($request->allQuestsData, $daily);

        $counter = 0;
        foreach ($data as $value) {

            $quest = Quest::create($value['quest']);

            foreach ($value['fields'] as $name => $field) {

                $fieldObj = new QuestField($field);
                $quest->field()->save($fieldObj);
            }
            ++$counter;
        }

        return $counter;

    }

    protected function getQuestsForWrite($array, $daily)
    {
        $data = [];
        $additionalFields = DB::table('additional_quests_fields')->pluck('name')->toArray();

        foreach ($array as $quest) {


            $Json = json_decode($quest['Json'], true);

            $data[$Json['questID']]['fields'] = [];
            foreach ($Json as $key => $value) {

                if(in_array($key, $additionalFields)) {

                    $data[$Json['questID']]['fields'][] = [

                        'fieldID' => AdditionalQuestsField::where('name', $key)->value('ID'),
                        'value' => $value
                    ];
                } else {

                    $data[$Json['questID']]['quest'][$key] = $value;
                }

                $data[$Json['questID']]['quest']['daily'] = $daily;
            }

            $data[$Json['questID']]['quest']['typeID'] = QuestType::where('type', $quest['Type'])->value('ID');
            unset($data[$Json['questID']]['quest']['questID']);

        }

        ksort($data);
        reset($data);
        return $data;
    }
}

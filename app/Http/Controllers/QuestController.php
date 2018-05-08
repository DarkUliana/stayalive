<?php

namespace App\Http\Controllers;

use App\AdditionalQuestsField;
use App\Http\Resources\QuestCollection;
use App\Quest;
use App\QuestField;
use App\QuestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quests = new QuestCollection(Quest::get());

        return response($quests, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!isset($request->allQuestsData)) {

            return response('Invalid data', 400);
        }

        QuestField::truncate();
        Quest::truncate();

        $data = $this->getQuestsForWrite($request->allQuestsData);

        $counter = 0;
        foreach ($data as $value) {

            $quest = Quest::create($value['quest']);

            $counter++;

            foreach ($value['fields'] as $name => $field) {

                $fieldObj = new QuestField($field);
                $quest->fields()->save($fieldObj);
            }
            ++$counter;
        }

        return response("$counter Quests written", 201);
    }

    protected function getQuestsForWrite($array)
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

            }

            $data[$Json['questID']]['quest']['typeID'] = QuestType::where('type', $quest['Type'])->value('ID');
            unset($data[$Json['questID']]['quest']['questID']);

        }

        ksort($data);
        reset($data);
        return $data;
    }
}

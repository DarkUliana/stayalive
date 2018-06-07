<?php

namespace App\Http\Controllers;

use App\Description;
use App\Dialog;
use App\DialogDescription;
use App\Http\Resources\DialogCollection;
use App\Quest;
use Illuminate\Http\Request;

class DialogController extends Controller
{
    public function index()
    {
        $beginQuestDialogs = Dialog::whereHas('quest', function ($q) {

            $q->where('daily', 0)->where('typeID', '<>', 8);
        })->get();

        $additionalDialogs = Dialog::whereHas('quest', function ($q) {

            $q->where('daily', 0)->where('typeID', 8);
        })->get();

        $array = [
            'beginQuestDialogs' => new DialogCollection($beginQuestDialogs),
            'additionalDialogs' => new DialogCollection($additionalDialogs)
        ];

        return response($array, 200);
    }

    public function store(Request $request)
    {
        if(!isset($request->beginQuestDialogs) or !isset($request->AdditionalDialogs)) {
            var_dump($request->all()); die();
            return response('Invalid data', 400);
        }

        Dialog::truncate();
        DialogDescription::truncate();

        $data = $this->prepareToWrite(array_merge($request->beginQuestDialogs, $request->AdditionalDialogs));

        $counter = 0;
        foreach ($data as $dialog) {


            $dialogObj = Dialog::create($dialog['dialog']);

            foreach ($dialog['descriptions'] as $description) {

                $descriptionObj = new DialogDescription($description);
                $dialogObj->descriptions()->save($descriptionObj);
            }
            ++$counter;
        }

        return response("$counter dialogs written");
    }

    protected function prepareToWrite($dialogs)
    {
        $array = [];

        foreach ($dialogs as $key => $dialog) {

            $temp = [];
//            $temp['dialog']['ID'] = $dialog['id'];
            $temp['dialog']['name'] = "Dialog$key";
            $temp['dialog']['questID'] = $dialog['questID'];

            foreach ($dialog['phrases'] as $key => $phrase) {

                $temp['descriptions'][] = [
                    'number' => $key,
                    'descriptionID' => Description::where('key', $phrase['phrase'])->value('ID'),
                    'speaker' => $phrase['speaker']
                ];
            }
            $array[] = $temp;
        }

        return $array;
    }
}

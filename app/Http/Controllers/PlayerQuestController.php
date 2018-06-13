<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerQuestCollection;
use App\PlayerQuest;
use Illuminate\Http\Request;

class PlayerQuestController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->googleID)) {
            return response('Invalid data', 400);
        }

        $quests = PlayerQuest::where('googleID', $request->googleID)->get();

        if($quests->isEmpty()) {
            return response('', 404);
        }

        $questsArr = new PlayerQuestCollection($quests);


        return response($questsArr, 200);

    }

    public function store(Request $request)
    {
        if (!isset($request->googleID)) {
            return response('Invalid data', 400);
        }

        $quests = $this->prepareForWrite($request->input());

        PlayerQuest::where('googleID', $request->googleID)->delete();

        $counter = 0;
        foreach ($quests as $quest) {

            PlayerQuest::create($quest);
            ++$counter;
        }

        return response("Recorded $counter player quests");

    }

    protected function prepareForWrite($data)
    {

        $array = [];

        foreach ($data['questsData'] as $quest) {

            $json = (array)json_decode($quest['questControllerData']);

            $array[] = array_merge([
                'googleID' => $data['googleID'],
                'type' => 'simple',
                'questID' => $quest['questID']],
                $json);

        }

        $json = (array)json_decode($data['starQuest']['questControllerData']);
        $array[] = array_merge([
            'googleID' => $data['googleID'],
            'type' => 'star',
            'questID' => $data['starQuest']['questID']
        ], $json);

        $json = (array)json_decode($data['plotQuest']['questControllerData']);
        $array[] = array_merge([
            'googleID' => $data['googleID'],
            'type' => 'plot',
            'questID' => $data['plotQuest']['questID']
        ], $json);

        return $array;
    }

}

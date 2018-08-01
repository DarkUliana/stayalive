<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerQuestCollection;
use App\Player;
use App\PlayerQuest;
use App\Quest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlayerQuestController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->googleID)) {
            return response('Invalid data', 400);
        }


        $quests = PlayerQuest::where('googleID', $request->googleID)->get();

        if ($quests->isEmpty()) {
            return response('', 404);
        }

        $daily = $quests->where('type', 'simple');
        foreach ($daily as $item) {

            $created_at = Carbon::createFromFormat('Y-m-d H:i:s', $item->created_at);
            $now = Carbon::now();

            if ($created_at < $now->subDay()) {

                $this->generateNewQuests($request->googleID, $daily->pluck('questID')->toArray());
                $quests = PlayerQuest::where('googleID', $request->googleID)->get();
            }

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

        $counter = 0;

        $diff = array_diff(PlayerQuest::where('googleID', $request->googleID)->pluck('questID')->toArray(), array_column($quests, 'questID'));
        PlayerQuest::where('googleID', $request->googleID)->whereIn('questID', $diff)->delete();
        foreach ($quests as $quest) {

            PlayerQuest::updateOrCreate(['googleID' => $request->googleID, 'questID' => $quest['questID']], $quest);

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

        if (isset($data['starQuest'])) {

            $json = (array)json_decode($data['starQuest']['questControllerData']);
            $array[] = array_merge([
                'googleID' => $data['googleID'],
                'type' => 'star',
                'questID' => $data['starQuest']['questID']
            ], $json);
        }


        if (isset($data['plotQuest'])) {

            $json = (array)json_decode($data['plotQuest']['questControllerData']);
            $array[] = array_merge([
                'googleID' => $data['googleID'],
                'type' => 'plot',
                'questID' => $data['plotQuest']['questID']
            ], $json);
        }

        return $array;
    }

    protected function generateNewQuests($googleID, $daily = [])
    {
        $levelMin = 3;
        $levelMax = 3;
        $questCount = 3;
        $level = Player::where('googleID', $googleID)->first()->CurrentLevel;

        $quests = $this->getAvailableQuests($level, $levelMin, $levelMax);

        $newQuests = $this->getRandomQuests($quests, $questCount, $daily);

        $this->deleteOldQuests($googleID);
        $this->storeNewQuests($newQuests, $googleID);

    }

    protected function getAvailableQuests($level, $levelMin, $levelMax)
    {
        $quests = Quest::where('daily', 1)
            ->where('level', '<', $level + $levelMax)
            ->where('level', '>', $level - $levelMin)
            ->pluck('ID')
            ->toArray();

        if (empty($quests)) {

            $quests = Quest::where('daily', 1)
                ->where('level', '<', $level + $levelMax)
                ->pluck('ID')
                ->toArray();
        }

        return $quests;
    }

    protected function getRandomQuests($quests, $questCount, $daily)
    {
        $newQuests = [];

        while (count($newQuests) < $questCount) {

            $rnd = random_int(0, count($quests) - 1);

            if ((!in_array($quests[$rnd], $daily)
                    || (count($quests) - count($daily)) < $questCount)
                && (!in_array($quests[$rnd], $newQuests)
                    || count($quests) < $questCount)) {

                $newQuests[] = $quests[$rnd];
            }
        }

        return $newQuests;
    }

    protected function storeNewQuests($newQuests, $googleID)
    {
        foreach ($newQuests as $quest) {

            PlayerQuest::create(
                [
                    'googleID' => $googleID,
                    'type' => 'simple',
                    'questID' => $quest,
                    'progress' => 0
                ]
            );
        }
    }

    protected function deleteOldQuests($googleID)
    {
        PlayerQuest::where('googleID', $googleID)
            ->where('type', 'simple')
            ->delete();
    }
}

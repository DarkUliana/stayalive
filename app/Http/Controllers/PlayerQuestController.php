<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlayerQuestCollection;
use App\Player;
use App\PlayerQuest;
use App\PlayerQuestReplacement;
use App\Quest;
use App\QuestReplacementTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlayerQuestController extends Controller
{

    public function index(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $quests = PlayerQuest::where('playerID', $playerID)->where('type', '!=', 'plot')->get();

        if ($quests->isEmpty()) {

            $quests = $this->generateFirstQuests($playerID);

        } else {

            $daily = $quests->where('type', 'simple');

            $questsTime = $daily->pluck('created_at')->toArray();

            $oldestQuest = min($questsTime);

            $time = QuestReplacementTime::pluck('time');
            $points = [];

            foreach ($time as $t) {

                $hours = explode(':', $t)[0];
                $minutes = explode(':', $t)[1];

                $point = Carbon::today()->addHours($hours)->addMinutes($minutes);
                if ($point < $oldestQuest) {

                    $point->addDay();
                }
                $points[] = $point;
            }

            foreach ($points as $point) {


                if ($point->between($oldestQuest, Carbon::now())) {

                    $quests = $this->generateNewQuests($playerID, $daily->pluck('questID')->toArray());
                    break;
                }


            }

        }

        $questsArr = new PlayerQuestCollection($quests);

        return response($questsArr, 200);

    }

    public function store(Request $request)
    {
        if (!isset($request->localID)) {
            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        PlayerQuestReplacement::updateOrCreate(['playerID' => $playerID], ['replaced' => $request->replaced]);
        $quests = $this->prepareForWrite($request->input(), $playerID);

        $counter = 0;

        foreach ($quests as $quest) {

            PlayerQuest::updateOrCreate(['ID' => $quest['ID']], $quest);

            ++$counter;
        }

        return response("Recorded $counter player quests");

    }

    protected function prepareForWrite($data, $playerID)
    {

        $array = [];

        foreach ($data['questsData'] as $quest) {

            $json = (array)json_decode($quest['questControllerData']);

            $array[] = array_merge([
                'playerID' => $playerID,
                'type' => 'simple',
                'questID' => $quest['questID']],
                $json);

        }

        if (isset($data['starQuest'])) {

            $json = (array)json_decode($data['starQuest']['questControllerData']);
            $array[] = array_merge([
                'playerID' => $playerID,
                'type' => 'star',
                'questID' => $data['starQuest']['questID']
            ], $json);
        }

        return $array;
    }

    protected function generateNewQuests($playerID, $daily = [])
    {
        $levelMin = 1;
        $questCount = 3;
        $level = Player::find($playerID)->CurrentLevel;

        $quests = $this->getAvailableQuests($level, $levelMin, $questCount);

        $newQuests = $this->getRandomQuests($quests, $questCount, $daily);

        $this->deleteOldQuests($playerID);
        $this->storeNewQuests($newQuests, $playerID);
        $this->resetQuestReplacement($playerID);

        return PlayerQuest::where('playerID', $playerID)->get();

    }

    protected function getAvailableQuests($level, $levelMin, $count)
    {

        do {

            $quests = Quest::where('daily', 1)
                ->where('typeID', '!=', 2)
                ->where('level', '>=', $level - $levelMin)
                ->where('level', '<=', $level)
                ->pluck('ID')
                ->toArray();

            ++$levelMin;

        } while (count($quests) < $count && ($level - $levelMin) >= 0);

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

    protected function storeNewQuests($newQuests, $playerID)
    {
        foreach ($newQuests as $quest) {

            PlayerQuest::create(
                [
                    'playerID' => $playerID,
                    'type' => 'simple',
                    'questID' => $quest,
                    'progress' => 0
                ]
            );
        }
    }

    protected function deleteOldQuests($playerID)
    {
        PlayerQuest::where('playerID', $playerID)
            ->where('type', 'simple')
            ->delete();
    }

    protected function resetQuestReplacement($playerID)
    {
        PlayerQuestReplacement::where('playerID', $playerID)->delete();
        PlayerQuestReplacement::create(['playerID' => $playerID, 'replaced' => 0]);
    }

    protected function generateFirstQuests($playerID)
    {

        $this->generateNewQuests($playerID);

        $star = Quest::where('typeID', 2)->orderBy('ID')->first();

            $quest = [
                'playerID' => $playerID,
                'questID' => $star->ID,
                'progress' => 0,
                'type' => 'star'
            ];

            PlayerQuest::create($quest);


        return PlayerQuest::where('playerID', $playerID)->where('type', '!=', 'plot')->get();
    }
}

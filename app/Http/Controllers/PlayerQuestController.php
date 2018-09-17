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
        if (!isset($request->googleID)) {

            return response('Invalid data', 400);
        }


        $quests = PlayerQuest::where('googleID', $request->googleID)->get();

        if ($quests->isEmpty()) {

            $quests = $this->generateFirstQuests($request->googleID);

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

                    $quests = $this->generateNewQuests($request->googleID, $daily->pluck('questID')->toArray());
                    break;
                }


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

        PlayerQuestReplacement::updateOrCreate(['googleID' => $request->googleID], ['replaced' => $request->replaced]);
        $quests = $this->prepareForWrite($request->input());

        $counter = 0;

        foreach ($quests as $quest) {

            PlayerQuest::updateOrCreate(['ID' => $quest['ID']], $quest);

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


//        if (isset($data['plotQuest'])) {
//
//            $json = (array)json_decode($data['plotQuest']['questControllerData']);
//            $array[] = array_merge([
//                'googleID' => $data['googleID'],
//                'type' => 'plot',
//                'questID' => $data['plotQuest']['questID']
//            ], $json);
//        }

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
        $this->resetQuestReplacement($googleID);

        return PlayerQuest::where('googleID', $googleID)->get();

    }

    protected function getAvailableQuests($level, $levelMin, $levelMax)
    {
        $quests = Quest::where('daily', 1)
            ->where('typeID', '!=', 2)
            ->where('level', '<', $level + $levelMax)
            ->where('level', '>', $level - $levelMin)
            ->pluck('ID')
            ->toArray();

        if (empty($quests)) {

            $quests = Quest::where('daily', 1)
                ->where('typeID', '!=', 2)
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

    protected function resetQuestReplacement($googleID)
    {
        PlayerQuestReplacement::where('googleID', $googleID)->delete();
        PlayerQuestReplacement::create(['googleID' => $googleID, 'replaced' => 0]);
    }

    protected function generateFirstQuests($googleID)
    {
        $plot = Quest::where('daily', 0)->where('typeID', '!=', 2)->orderBy('ID')->first();
        $star = Quest::where('typeID', 2)->orderBy('ID')->first();
        $daily = Quest::where('daily', 1)->where('typeID', '!=', 2)->orderBy('ID')->limit(3)->get();

        $daily->push($plot)->push($star);

        foreach ($daily as $quest) {
            $array = [
                'googleID' => $googleID,
                'questID' => $quest->ID,
                'progress' => 0
            ];


            $array['type'] = 'simple';

            if ($quest->typeID == 2) {

                $array['type'] = 'star';
            }

            if ($quest->daily == 0) {

                $array['type'] = 'plot';
            }

            PlayerQuest::create($array);
        }

        return PlayerQuest::where('googleID', $googleID)->get();
    }
}

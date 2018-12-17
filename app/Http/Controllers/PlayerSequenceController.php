<?php

namespace App\Http\Controllers;

use App\PlayerQuest;
use App\PlayerSequence;
use App\DiaryStorageNote;
use Illuminate\Http\Request;

class PlayerSequenceController extends Controller
{
    public function get(Request $request)
    {

        if (!isset($request->localID)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        $sequences = PlayerSequence::where('playerID', $playerID)->get();

        $quest = PlayerQuest::firstOrCreate(['playerID' => $playerID, 'type' => 'plot'], ['progress' => 0, 'questID' => -1]);

        $data['questControllerData'] = json_encode(['progress' => $quest->progress, 'ID' => $quest->ID]);
        $data['questID'] = $quest->questID;
        $data['localID'] = $request->localID;
        $data['openedSequences'] = $sequences->toArray();

        if ($sequences->count() < DiaryStorageNote::count()) {

            $missing = $this->getMissingSequences($sequences, $playerID);
            $data['openedSequences'] = array_merge($data['openedSequences'], $missing);
        }

        return response($data, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->localID) || !isset($request->questControllerData)
            || !isset($request->questID) || !isset($request->openedSequences)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        $questControllerData = json_decode($request->questControllerData);
        $playerQuest['questID'] = $request->questID;
        $playerQuest['progress'] = $questControllerData->progress;


        PlayerQuest::updateOrCreate(['playerID' => $playerID, 'type' => 'plot'], $playerQuest);

        PlayerSequence::where('playerID', $playerID)->delete();

        foreach ($request->openedSequences as $sequence) {

            $data = $sequence;
            $data['playerID'] = $playerID;

            PlayerSequence::create($data);
        }

        return response('ok', 200);
    }

    protected function getMissingSequences($sequences, $playerID)
    {

        $sequencesArr = [];

        $IDs = $sequences->pluck('sequenceID');
        $missing = DiaryStorageNote::whereNotIn('ID', $IDs)->pluck('noteID');

        foreach ($missing as $item) {

            $temp = [
                'playerID' => $playerID,
                'sequenceID' => $item,
                'state' => 0
            ];
            PlayerSequence::create($temp);
            unset($temp['playerID']);
            $sequencesArr[] = $temp;

        }

        return $sequencesArr;
    }
}

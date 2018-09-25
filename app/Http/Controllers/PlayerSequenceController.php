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

        if (!isset($request->googleID)) {

            return response('Invalid data!', 400);
        }

        $sequences = PlayerSequence::where('googleID', $request->googleID)->get();

        $quest = PlayerQuest::firstOrCreate(['googleID' => $request->googleID, 'type' => 'plot'], ['progress' => 0, 'questID' => -1]);

        $data['questControllerData'] = json_encode(['progress' => $quest->progress, 'ID' => $quest->ID]);
        $data['questID'] = $quest->questID;
        $data['googleID'] = $request->googleID;
        $data['openedSequences'] = $sequences->toArray();

        if ($sequences->count() < DiaryStorageNote::count()) {

            $missing = $this->getMissingSequences($sequences, $request->googleID);
            $data['openedSequences'] = array_merge($data['openedSequences'], $missing);
        }

        return response($data, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->googleID) || !isset($request->questControllerData)
            || !isset($request->questID) || !isset($request->openedSequences)) {

            return response('Invalid data!', 400);
        }

        $questControllerData = json_decode($request->questControllerData);
        $playerQuest['questID'] = $request->questID;
        $playerQuest['progress'] = $questControllerData->progress;


        PlayerQuest::updateOrCreate(['googleID' => $request->googleID, 'type' => 'plot'], $playerQuest);

        PlayerSequence::where('googleID', $request->googleID)->delete();

        foreach ($request->openedSequences as $sequence) {

            $data = $sequence;
            $data['googleID'] = $request->googleID;

            PlayerSequence::create($data);
        }

        return response('ok', 200);
    }

    protected function getMissingSequences($sequences, $googleID)
    {

        $sequencesArr = [];

        $IDs = $sequences->pluck('sequenceID');
        $missing = DiaryStorageNote::whereNotIn('ID', $IDs)->pluck('ID');

        foreach ($missing as $item) {

            $temp = [
                'googleID' => $googleID,
                'sequenceID' => $item,
                'state' => 0
            ];
            PlayerSequence::create($temp);
            unset($temp['googleID']);
            $sequencesArr[] = $temp;

        }

        return $sequencesArr;
    }
}

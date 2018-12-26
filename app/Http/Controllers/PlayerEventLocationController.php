<?php

namespace App\Http\Controllers;

use App\PlayerEventConditions;
use App\PlayerEventLocation;
use App\PlayerEventTime;
use Illuminate\Http\Request;

class PlayerEventLocationController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        $array['localID'] = $request->localID;
        $array['timePreviouslyAttempt'] = PlayerEventTime::where('playerID', $playerID)->value('timePreviouslyAttempt');
        $array['raisedEventLocations'] = PlayerEventLocation::where('playerID', $playerID)->get()->toArray();
        $array['raisedEventConditions'] = PlayerEventConditions::where('playerID', $playerID)->get()->toArray();

        return response($array, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        if (isset($request->timePreviouslyAttempt)) {

            PlayerEventTime::updateOrCreate(['playerID' => $playerID], ['timePreviouslyAttempt' => $request->timePreviouslyAttempt]);
        }

        if (isset($request->raisedEventLocations)) {

            PlayerEventLocation::where('playerID', $playerID)->delete();

            foreach ($request->raisedEventLocations as $location) {

                PlayerEventLocation::create(array_merge($location, ['playerID' => $playerID]));
            }
        }

        if (isset($request->raisedEventConditions)) {

            PlayerEventConditions::where('playerID', $playerID)->delete();

            foreach ($request->raisedEventConditions as $condition) {

                PlayerEventConditions::create(array_merge($condition, ['playerID' => $playerID]));
            }
        }

        return response('ok', 200);
    }
}

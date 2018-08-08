<?php

namespace App\Http\Controllers;

use App\PlayerQuest;
use App\QuestReplacementTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuestTimerController extends Controller
{
    public function __invoke()
    {
        $time = QuestReplacementTime::pluck('time');
        $points = [];

        foreach ($time as $t) {

            $hours = explode(':', $t)[0];
            $minutes = explode(':', $t)[1];

            $point = Carbon::today()->addHours($hours)->addMinutes($minutes);
            if ($point < Carbon::now()) {

                $point->addDay();
            }
            $points[] = $point;
        }

        $nextUpdate = min($points);

        $timeToUpdate = $nextUpdate->diffInSeconds(Carbon::now());

        return response($timeToUpdate, 200);
    }
}

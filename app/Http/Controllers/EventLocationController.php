<?php

namespace App\Http\Controllers;

use App\EventLocation;
use App\EventLocationSetting;
use App\EventLocationTimer;
use Illuminate\Http\Request;

class EventLocationController extends Controller
{
    public function get()
    {
        $locations = EventLocation::all();

        $array['timerToNewAttempt'] = EventLocationTimer::first()->timerToNewAttempt;
        $array['eventLocations'] = [];

        foreach ($locations as $location) {

            $array['eventLocations'][$location->triggerType]['triggerType'] = $location->triggerType;

            $temp = $location->toArray();
            unset($temp['triggerType']);
            $array['eventLocations'][$location->triggerType]['eventLocationSettings'][$location->conditionName] = $temp;

            $array['eventLocations'][$location->triggerType]['eventLocationSettings'][$location->conditionName]['locationSettings'] = $location->settings->toArray();

        }

        foreach ($array['eventLocations'] as &$one) {

            $one['eventLocationSettings'] = array_values($one['eventLocationSettings']);
        }

        $array['eventLocations'] = array_values($array['eventLocations']);

        return response($array, 200);
    }

    public function post(Request $request)
    {
        EventLocation::truncate();
        EventLocationSetting::truncate();
        EventLocationTimer::truncate();

        EventLocationTimer::create(['timerToNewAttempt' => $request->timerToNewAttempt]);

        foreach ($request->eventLocations as $trigger) {

            foreach ($trigger['eventLocationSettings'] as $location) {

                $temp = $location;
                unset($temp['locationSettings']);
                $temp['triggerType'] = $trigger['triggerType'];

                $newLocation = EventLocation::create($temp);

                foreach ($location['locationSettings'] as $setting) {

                    $newSetting = new EventLocationSetting($setting);
                    $newLocation->settings()->save($newSetting);
                }
            }
        }

        return response('ok', 200);
    }

}

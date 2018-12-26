<?php

namespace App\Http\Controllers\Admin;

use App\EventLocationSetting;
use App\EventLocationTimer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\EventLocation;
use Illuminate\Http\Request;

class EventLocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        $timerToNewAttempt = EventLocationTimer::first();

        if (!empty($keyword)) {
            $eventLocations = EventLocation::latest()->paginate($perPage);
        } else {
            $eventLocations = EventLocation::latest()->paginate($perPage);
        }

        return view('admin.event-locations.index', compact('eventLocations', 'timerToNewAttempt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.event-locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'triggerType' => 'required|integer',
            'conditionName' => 'required|string',
            'respownCount' => 'required|integer',
            'timeToActivate' => 'required|numeric',
            'timePeriod' => 'required|numeric',

        ]);
        $requestData = $request->all();
        unset($requestData['settings']);
        
        $eventLocation = EventLocation::create($requestData);


        if (isset($request->settings)) {

            foreach ($request->settings as $setting) {

                $settingObject = new EventLocationSetting($setting);
                $eventLocation->settings()->save($settingObject);
            }

        }

        return redirect('event-locations')->with('flash_message', 'EventLocation added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $eventLocation = EventLocation::findOrFail($id);

        return view('admin.event-locations.show', compact('eventLocation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $eventLocation = EventLocation::findOrFail($id);

        return view('admin.event-locations.edit', compact('eventLocation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'triggerType' => 'required|integer',
            'conditionName' => 'required|string',
            'respownCount' => 'required|integer',
            'timeToActivate' => 'required|numeric',
            'timePeriod' => 'required|numeric',

        ]);
        $requestData = $request->all();
        unset($requestData['settings']);

        $eventLocation = EventLocation::findOrFail($id);
        $eventLocation->update($requestData);

        EventLocationSetting::where('locationID', $id)->delete();

        if (isset($request->settings)) {

            foreach ($request->settings as $setting) {

                $settingObject = new EventLocationSetting($setting);
                $eventLocation->settings()->save($settingObject);
            }

        }

        return redirect('event-locations')->with('flash_message', 'EventLocation updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        EventLocation::destroy($id);
        EventLocationSetting::where('locationID', $id)->delete();

        return redirect('event-locations')->with('flash_message', 'EventLocation deleted!');
    }

    public function getSetting(Request $request)
    {
        $index = $request->index + 1;

        return view('admin.event-locations.setting', compact('index'));
    }

    public function updateTimer(Request $request)
    {
        $this->validate($request, [
            'timerToNewAttempt' => 'required|numeric'
        ]);

        $timer = EventLocationTimer::firstOrNew([]);
        $timer->timerToNewAttempt = $request->timerToNewAttempt;
        $timer->save();

        return redirect()->back();
    }
}

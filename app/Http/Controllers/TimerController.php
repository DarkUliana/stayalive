<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Timer;

class TimerController extends Controller
{
    protected $type;

    public function __construct(Request $request)
    {
        $this->type = $request->segment(3);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreate(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        $data = [
            'playerID' => $playerID,
            'type' => $this->type,
        ];

        $timer = Timer::updateOrCreate($data);

        if (isset($request->seconds)) {

            $time = new Carbon($timer->start);
            $timer->start = $time->addSeconds($request->seconds);
        } else {

            $timer->start = Carbon::now();
        }

        $timer->save();

        return response($timer->start, 201);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        $timer = Timer::where('playerID', $playerID)
            ->where('type', $this->type)
            ->first();

        if (empty($timer)) {
            return response('NULL', 404);
        }

        return response($timer->start, 200);
    }

}

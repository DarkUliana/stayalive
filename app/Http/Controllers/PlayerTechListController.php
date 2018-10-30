<?php

namespace App\Http\Controllers;

use App\PlayerRestorableObject;
use Illuminate\Http\Request;
use App\PlayerBuildingTechnology as Build;
use App\PlayerTechnologiesStates as States;
use Illuminate\Support\Facades\DB;

class PlayerTechListController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $build = Build::where('playerID', $playerID)->with('states')->first();


        if (empty($build)) {
            return response('Not found', 404);
        }

        $build = $this->prepareDataForResponse($build->toArray(), $request);

        return response($build, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!isset($request->localID) || !isset($request->playerTechList)) {
            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $data = $this->prepareDataForWrite($request->input(), $playerID);

        States::where('playerID', $playerID)->delete();
        foreach ($data['states'] as $state) {
            States::create($state);
        }

        $build = Build::firstOrCreate(['playerID' => $playerID]);
        $build->update($data['build']);

        return response('ok', 200);
    }


    protected function prepareDataForWrite($data, $playerID)
    {
        $write['build'] = $data;
        if (isset($write['build']['playerTechList'])) {
            unset($write['build']['playerTechList']);
        }

        foreach ($data['playerTechList'] as $state) {

            $write['states'][] = [
                'playerID' => $playerID,
                'technologyID' => $state['id'],
                'technologyState' => $state['technologyState']
            ];
        }

        return $write;
    }

    protected function prepareDataForResponse($data, Request $request)
    {
        $response = $data;

        unset($response['states']);

        foreach ($data['states'] as $state) {

            $response['playerTechList'][] = [
                'id' => $state['technologyID'],
                'technologyState' => $state['technologyState']
            ];
        }

        $response['localID'] = $request->localID;

        return $response;
    }

    public function getRaftState(Request $request)
    {
        if(!isset($request->localID)) {
            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $state = PlayerRestorableObject::where('playerID', $playerID)->where('objectKey', 'Restorable_Raft')->first();

        if(!$state) {

            return response('Not found', 404);
        }

        return response($state->isBuilded, 200);
    }
}

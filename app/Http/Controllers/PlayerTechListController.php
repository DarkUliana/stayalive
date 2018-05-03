<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlayerBuildingTechnology as Build;
use App\PlayerTechnologiesStates as States;
use Illuminate\Support\Facades\DB;

class PlayerTechListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!isset($request->googleID) || !isset($request->playerTechList)) {
            return response('Invalid data', 400);
        }

        $data = $this->prepareDataForWrite($request->input());

        States::where('googleID', $request->googleID)->delete();
        foreach ($data['states'] as $state) {
            States::create($state);
        }

        $build = Build::firstOrCreate(['googleID' => $request->googleID]);
        $build->update($data['build']);

        return response('ok', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $build = Build::where('googleID', $request->googleID)->with('states')->first();


        if (empty($build)) {
            return response('Not found', 404);
        }

        $build = $this->prepareDataForResponse($build->toArray(), $request);

        return response($build, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    protected function prepareDataForWrite($data)
    {
        $write['build'] = $data;
        if (isset($write['build']['playerTechList'])) {
            unset($write['build']['playerTechList']);
        }

        foreach ($data['playerTechList'] as $state) {

            $write['states'][] = [
                'googleID' => $data['googleID'],
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

        $response['googleID'] = $request->googleID;
//        $response['playerTechList'] = json_encode($response['playerTechList']);
        return $response;
    }
}

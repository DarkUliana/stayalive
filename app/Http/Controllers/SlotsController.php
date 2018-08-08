<?php

namespace App\Http\Controllers;

use App\PlayerBodyPosition;
use Illuminate\Http\Request;
use App\Http\Resources\SlotCollection;
use Illuminate\Support\Facades\Storage;


class SlotsController extends Controller
{
    protected $model;
    protected $type;

    public function __construct(Request $request)
    {
        $this->type = $request->segment(2);

        switch ($this->type) {
            case 'equipment':
                $this->model = 'App\Equipment';
                break;
            case 'inventory':
                $this->model = 'App\Inventory';
                break;
            case 'after-craft-items':
                $this->model = 'App\AfterCraftItems';
                break;
            case 'player-chest-items':
                $this->model = 'App\PlayerChestItems';
                break;
            case 'player-body':
                $this->model = 'App\PlayerBodySlot';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        if (!isset($request->googleID)) {

            return response('Invalid data!', 400);
        }

        $slots = new SlotCollection($this->model::where('googleID', $request->googleID)->get()->sortBy('Index'));

        return response($slots, 200);
    }


    /**
     * Create or update slots.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrCreate(Request $request)
    {
        if (!isset($request->slotsData) || !isset($request->googleID)) {


            return response('Invalid data', 400);
        }


        $this->model::where('googleID', $request->googleID)->delete();

        if ($this->type == 'player-body') {

            $this->updatePlayerBodyPosition($request);
        }

        $counter = 0;
        foreach ($request->slotsData as $value) {

            $slot = json_decode($value['slotInfo'], true);
            $slot['itemID'] = $value['itemID'];
            $slot['googleID'] = $request->googleID;

            if ($this->model::create($slot)) {

                $counter++;
            }
        }

        return response("$counter items written", 200);
    }

    protected function updatePlayerBodyPosition($request)
    {

        $position = $request->position;
        $position['sceneName'] = $request->sceneName;

        PlayerBodyPosition::updateOrCreate(['googleID' => $request->googleID], $position);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}

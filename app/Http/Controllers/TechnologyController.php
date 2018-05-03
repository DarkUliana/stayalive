<?php

namespace App\Http\Controllers;

use App\Technology;
use App\TechnologyItems;
use Illuminate\Http\Request;
use App\Http\Resources\TechnologyCollection;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technologies = new TechnologyCollection(Technology::with('items')->get());

        return response($technologies, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!isset($request->technologies)) {

            return response('Invalid data', 400);
        }

        TechnologyItems::truncate();
        Technology::truncate();

        $counter = 0;
        foreach ($request->technologies as $value) {

            $techArr = $this->getTechnologiesForWrite($value);

            $objTech = Technology::create($techArr['technologyColumns']);

            $counter++;
            foreach ($techArr['items'] as $item) {

                $techItem = new TechnologyItems($item);
                $objTech->items()->save($techItem);
            }

        }
        return response("$counter Technologies written", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Technology  $technologies
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technologies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Technology  $technologies
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technologies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Technology  $technologies
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technologies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Technology  $technologies
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technologies)
    {
        //
    }

    protected function getTechnologiesForWrite($data)
    {
//        var_dump($data); die();

        if(isset($data['oppenedItems'])) {
            foreach ($data['oppenedItems'] as $value) {
                $array['items'][] = [
                    'itemID' => $value
                ];
            }
        } else {
            $array['items'] = [];
        }


        $array['technologyColumns'] = $data;
        unset($array['technologyColumns']['oppenedItems']);

        return $array;
    }
}

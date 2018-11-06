<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Recipe;
use App\Technology;
use App\TechnologyItems;
use Illuminate\Http\Request;
use App\Item;

class TechnologiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $sort = $request->get('sort');

        $type = $request->get('type');
        if (empty($type)) {
            $type = 'asc';
        }

        $perPage = 25;

        $technologies = Technology::where([]);

        if (!empty($keyword)) {

            $technologies = $technologies->where('name', 'like', "%$keyword%")->latest();

        }
        if (!empty($sort)) {

            $technologies = $technologies->orderBy($sort, $type);

        }


        if (empty($keyword) && empty($sort)) {

            $technologies = $technologies->latest('updated_at');
        }

        $technologies = $technologies->paginate($perPage);

        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $items = Item::all();
        return view('admin.technologies.create', compact('items'));
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

        $requestData = $request->all();
        $data = $this->prepareDataForWrite($requestData);

        $technology = Technology::create($data['properties']);
        foreach ($data['items'] as $item) {

            $techItem = new TechnologyItems($item);
            $technology->items()->save($techItem);
        }

        return redirect('technologies')->with('flash_message', 'Technology added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $technology = Technology::findOrFail($id);

        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $technology = Technology::findOrFail($id);
        $technologies = Technology::all();
        $items = Item::all();
        $selectedItems = $this->itemsToArray($technology->items);
        $recipe = Recipe::where('ItemID', $technology->ID)->first();
        $selectedTechnologies = [];
        if ($recipe) {

            $selectedTechnologies = RecipesController::getValuesFromEloquentArray($recipe->technologies, 'technologyID');
        }


        return view('admin.technologies.edit', compact('technology', 'items', 'selectedItems', 'recipe',
            'technologies', 'selectedTechnologies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $data = $this->prepareDataForWrite($requestData);

        $technology = Technology::findOrFail($id);
        $technology->update($data['properties']);

        TechnologyItems::where('technologyID', $id)->delete();

        foreach ($data['items'] as $item) {

            $techItem = new TechnologyItems($item);
            $technology->items()->save($techItem);
        }

        return redirect('technologies')->with('flash_message', 'Technology updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        TechnologyItems::where('technologyID', $id)->delete();
        Technology::destroy($id);

        return redirect('technologies')->with('flash_message', 'Technology deleted!');
    }

    protected function prepareDataForWrite($data)
    {
        $technology['items'] = [];
        if (isset($data['items'])) {

            foreach ($data['items'] as $item) {
                $technology['items'][] = [
                    'itemID' => $item
                ];
            }

        }
        $technology['properties'] = $data;
        unset($technology['properties']['items']);

        return $technology;
    }

    public function itemsToArray($items)
    {
        $array = [];
        foreach ($items as $item) {
            $array[] = $item->itemID;
        }
        return $array;
    }
}

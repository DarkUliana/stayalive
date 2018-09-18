<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Recipe;
use App\RecipeComponents;
use App\RecipeTechnologies;
use Illuminate\Http\Request;
use App\Item;
use App\Technology;
use Illuminate\Support\Facades\Cookie;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $filter = $request->get('filter');
        $sort = $request->get('sort');

        $type = 'asc';
        if (!empty ($request->get('type'))) {
            $type = $request->get('type');
        }

        $perPage = 25;

        $recipes = Recipe::where([]);

        if (!empty($keyword)) {
            $recipes = $recipes->where('name', 'like', "%$keyword%");
        }
        if (!empty($filter)) {
            $recipes = $recipes->where('InventorySlotType', $filter);
        }
        if (!empty($sort)) {
            $recipes = $recipes->orderBy($sort, $type);
        }

        if (empty($keyword) && empty($filter) && empty($sort)) {
            $recipes = $recipes->latest();
        }

        $recipes = $recipes->paginate($perPage);
        $items = Item::all();

        $hideSidebar = isset($_COOKIE['table']) ? $_COOKIE['table'] : 0;



        return view('admin.recipes.index', compact('recipes', 'items', 'hideSidebar'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $items = Item::all();
        $technologies = Technology::all();

        return view('admin.recipes.create', compact('items', 'technologies'));
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

        $recipe = Recipe::create($data['properties']);

        foreach ($data['components'] as $component) {

            $recipeComponent = new RecipeComponents($component);
            $recipe->components()->save($recipeComponent);
        }

        foreach ($data['technologies'] as $technology) {

            $recipeTechnology = new RecipeTechnologies($technology);
            $recipe->technologies()->save($recipeTechnology);
        }

        return redirect('recipes')->with('flash_message', 'Recipe added!');
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
        $recipe = Recipe::findOrFail($id);

        return view('admin.recipes.show', compact('recipe'));
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
        $recipe = Recipe::findOrFail($id);
        $items = Item::all();
        $selectedItems = $this->getValuesFromEloquentArray($recipe->components, 'itemID');
        $technologies = Technology::all();
        $selectedTechnologies = $this->getValuesFromEloquentArray($recipe->technologies, 'technologyID');

        return view('admin.recipes.edit', compact('recipe', 'items', 'selectedItems', 'technologies', 'selectedTechnologies'));
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

//        var_dump($request->input()); die();
        if (isset($request->recipes)) {

            foreach ($request->recipes as $recipe) {

                $this->save($recipe, $recipe['ID'], false);
            }

        } else {

            $this->save($request->all(), $id);
        }
        if ($request->ajax()) {

            return response('OK', 200);
        }

        return redirect('recipes')->with('flash_message', 'Recipe updated!');
    }

    protected function save($requestData, $id, $technology = true)
    {
        $data = $this->prepareDataForWrite($requestData);

        $recipe = Recipe::findOrFail($id);
        $recipe->update($data['properties']);

        RecipeComponents::where('recipeID', $id)->delete();


        foreach ($data['components'] as $component) {

            if ($component['itemID']) {

                $recipeComponent = new RecipeComponents($component);
                $recipe->components()->save($recipeComponent);
            }

        }

        if ($technology) {

            RecipeTechnologies::where('recipeID', $id)->delete();

            foreach ($data['technologies'] as $technology) {

                $recipeTechnology = new RecipeTechnologies($technology);
                $recipe->technologies()->save($recipeTechnology);
            }
        }

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
        Recipe::destroy($id);
        RecipeComponents::where('recipeID', $id)->delete();
        RecipeTechnologies::where('recipeID', $id)->delete();

        return redirect('recipes')->with('flash_message', 'Recipe deleted!');
    }

    protected function prepareDataForWrite($data)
    {
        $recipe['properties'] = $data;
        $recipe['technologies'] = [];
        $recipe['components'] = [];
        unset($recipe['properties']['technologies']);
        unset($recipe['properties']['components']);

        if (isset($data['components'])) {
            $recipe['components'] = $data['components'];
        }

        if (isset($data['technologies'])) {

            foreach ($data['technologies'] as $technology) {
                $recipe['technologies'][] = [
                    'technologyID' => $technology
                ];
            }
        }

        return $recipe;
    }

    public function component(Request $request)
    {
        $items = Item::all();
        $counter = $request->counter + 1;
        return view('admin.recipes.component', compact('counter', 'items'));
    }


    public function getValuesFromEloquentArray($items, $key)
    {
        $array = [];
        foreach ($items as $item) {
            $array[] = $item->{$key};
        }
        return $array;
    }

}

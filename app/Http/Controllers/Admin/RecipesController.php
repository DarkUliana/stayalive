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
        $perPage = 25;

        if (!empty($keyword)) {
            $recipes = Recipe::where('Name', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $recipes = Recipe::latest()->paginate($perPage);
        }

        return view('admin.recipes.index', compact('recipes'));
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
     * @param  int  $id
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
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        $items = Item::all();
        $selectedItems = getValuesFromEloquentArray($recipe->components, 'itemID');
        $technologies = Technology::all();
        $selectedTechnologies = getValuesFromEloquentArray($recipe->technologies, 'technologyID');

        return view('admin.recipes.edit', compact('recipe', 'items', 'selectedItems', 'technologies', 'selectedTechnologies'));
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
//        var_dump($request->input()); die();
        $requestData = $request->all();
        $data = $this->prepareDataForWrite($requestData);
        
        $recipe = Recipe::findOrFail($id);
        $recipe->update($data['properties']);

        RecipeComponents::where('recipeID', $id)->delete();
        RecipeTechnologies::where('recipeID', $id)->delete();

        foreach ($data['components'] as $component) {

            $recipeComponent = new RecipeComponents($component);
            $recipe->components()->save($recipeComponent);
        }

        foreach ($data['technologies'] as $technology) {

            $recipeTechnology = new RecipeTechnologies($technology);
            $recipe->technologies()->save($recipeTechnology);
        }



        return redirect('recipes')->with('flash_message', 'Recipe updated!');
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
        Recipe::destroy($id);

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
}

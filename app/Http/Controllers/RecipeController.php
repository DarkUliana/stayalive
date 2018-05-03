<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\RecipeComponents;
use App\RecipeTechnologies;
use App\Http\Resources\RecipeCollection;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = new RecipeCollection(Recipe::with('components')->with('technologies')->get());

        return response($recipes, 200);
    }

    public function store(Request $request)
    {

        if (!isset($request->AllRecepies)) {
            return response('Invalid data', 400);
        }

        RecipeComponents::truncate();
        RecipeTechnologies::truncate();
        Recipe::truncate();

        $recipes = $this->getRecipesForWrite($request->AllRecepies);
        $counter = 0;

        foreach ($recipes as $data) {

            $recipe = Recipe::create($data['recipe']);

            $counter++;

            foreach ($data['components'] as $component) {

                $recipeComponent = new RecipeComponents($component);
                $recipe->components()->save($recipeComponent);
            }

            foreach ($data['technologies'] as $technology) {

                $recipeTechnology = new RecipeTechnologies($technology);
                $recipe->technologies()->save($recipeTechnology);
            }

        }
        return response("$counter Recipes written", 201);

    }

    protected  function getRecipesForWrite($recipes)
    {
        $recipesForWrite = [];
        foreach ($recipes as $recipe) {
            $decodedData = json_decode($recipe['Data'], true);
            $data['recipe'] = $decodedData;
            $data['recipe']['Type'] = $recipe['Type'];
            unset($data['recipe']['Components']);
            unset($data['recipe']['TechnologiesIDs']);

            $data['components'] = [];
            foreach ($decodedData['Components'] as $component) {
                $data['components'][] = [
                    'itemID' => $component['id'],
                    'neededCount' => $component['neededCount']
                ];
            }

            $data['technologies'] = [];
            foreach ($decodedData['TechnologiesIDs'] as $technology) {
                $data['technologies'][] = [
                    'technologyID' => $technology
                ];
            }
            $recipesForWrite[] = $data;
        }

        return $recipesForWrite;

    }

}

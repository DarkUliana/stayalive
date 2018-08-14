<?php

namespace App\Http\Controllers;

use App\PlayerLearnedRecipe;
use Illuminate\Http\Request;

class PlayerLearnedRecipeController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->googleID)) {

            return response('Invalid data!', 400);
        }

        $recipes = PlayerLearnedRecipe::where('googleID', $request->googleID)->get();

        return response(['googleID' => $request->googleID, 'learnedRecipes' => $recipes], 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->googleID) || !isset($request->learnedRecipes)) {

            return response('Invalid data!', 400);
        }

        PlayerLearnedRecipe::where('googleID', $request->googleID)->delete();

        foreach ($request->learnedRecipes as $recipe) {

            $data = $recipe;
            $data['googleID'] = $request->googleID;
            PlayerLearnedRecipe::create($data);
        }

        return response('ok', 201);
    }
}
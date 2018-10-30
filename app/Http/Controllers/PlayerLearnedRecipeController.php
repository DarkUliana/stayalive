<?php

namespace App\Http\Controllers;

use App\PlayerLearnedRecipe;
use Illuminate\Http\Request;

class PlayerLearnedRecipeController extends Controller
{
    public function get(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        $recipes = PlayerLearnedRecipe::where('playerID', $playerID)->get();

        return response(['localID' => $request->localID, 'learnedRecipes' => $recipes], 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->localID) || !isset($request->learnedRecipes)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        PlayerLearnedRecipe::where('playerID', $playerID)->delete();

        foreach ($request->learnedRecipes as $recipe) {

            $data = $recipe;
            $data['playerID'] = $playerID;
            PlayerLearnedRecipe::create($data);
        }

        return response('ok', 201);
    }
}
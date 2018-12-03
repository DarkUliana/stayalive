<?php

namespace App\Http\Controllers;

use App\SceneChest;
use Illuminate\Http\Request;

class SceneChestController extends Controller
{
    public function get()
    {
        $chests['chestsSettings'] = SceneChest::all();

        return response($chests, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->chestsSettings)) {

            return response('Invalid data!', 400);
        }

        SceneChest::truncate();

        foreach ($request->chestsSettings as $setting) {

            SceneChest::create($setting);
        }

        return response('ok', 200);
    }
}

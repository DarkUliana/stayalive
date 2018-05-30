<?php

namespace App\Http\Controllers;

use App\PlayerReward;
use Illuminate\Http\Request;

class PlayerRewardController extends Controller
{
    public function index(Request $request)
    {
        if (!isset($request->googleID)) {

            return response('Invalid data', 400);
        }
        $rewards = PlayerReward::where('googleID', $request->googleID)->get()->toArray();

        return response(['allChestDatas' => $rewards], 200);
    }

    public function store(Request $request)
    {
//        var_dump($request->all()); die();
        if (!isset($request->googleID)) {

            return response('Invalid data', 400);
        }

        PlayerReward::where('googleID', $request->googleID)->delete();

        foreach ($request->allChestDatas as $reward) {

            PlayerReward::create(array_merge(['googleID' => $request->googleID], $reward));
        }

        return response('ok', 200);
    }
}

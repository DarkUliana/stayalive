<?php

namespace App\Http\Controllers;

use App\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        return Reward::all()->toArray();
    }

    public function store(Request $request)
    {
        if (!isset($request->rewards)) {
            return response('Invalid data', 400);
        }

        foreach ($request->rewards as $reward) {

            $temp = $reward;
            unset($temp['id']);
            unset($temp['rewardList']);

            $rewardObj = Reward::create($temp);
             foreach ($reward->rewardList as $item) {

                 
             }
        }
    }
}

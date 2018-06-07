<?php

namespace App\Http\Controllers;

use App\Reward;
use App\RewardItem;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function index()
    {
        $rewards = Reward::with('rewardList')->get()->toArray();
        return response(['rewards' => $rewards], 200);
    }

    public function store(Request $request)
    {
        if (!isset($request->rewards)) {
            return response('Invalid data', 400);
        }

        Reward::truncate();
        RewardItem::truncate();

        $counter = 0;
        foreach ($request->rewards as $reward) {

            $temp = $reward;
            unset($temp['id']);
            unset($temp['rewardList']);

            $rewardObj = Reward::create($temp);

             foreach ($reward['rewardList'] as $item) {

                 $itemObj = new RewardItem($item);
                 $rewardObj->rewardList()->save($itemObj);

             }
             ++$counter;
        }

        return response("$counter Rewards were recorded");
    }
}

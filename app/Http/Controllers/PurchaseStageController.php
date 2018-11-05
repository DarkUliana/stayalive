<?php

namespace App\Http\Controllers;

use App\PurchaseStage;
use Illuminate\Http\Request;

class PurchaseStageController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data', 400);
        }

        $playerID = getPlayerID($request->localID);

        $purchase = $request->input();

        unset($purchase['localID']);
        $purchase['playerID'] = $playerID;

        PurchaseStage::create($purchase);

        return response('ok', 200);

    }
}

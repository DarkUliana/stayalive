<?php

namespace App\Http\Controllers;

use App\BanList;
use Illuminate\Http\Request;

class BanListController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Invalid data!', 400);
        }

        $playerID = getPlayerID($request->localID);

        if (BanList::where('playerID', $playerID)->first()) {

            return response(1, 200);
        }

        return response(0, 200);
    }
}

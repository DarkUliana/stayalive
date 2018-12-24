<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Online;
use Carbon\Carbon;

class OnlineController extends Controller
{
    public function __invoke(Request $request)
    {
        return response(true, 200);

//        if (!isset($request->localID)) {
//
//            return response('Your request has no localID', 400);
//        }
//
//        $playerID = getPlayerID($request->localID);
//
//        $online = Online::where(['playerID' => $playerID])->first();
//
//
//        if (empty($online)) {
//
//            if (!isset($request->withoutTouch)) {
//                Online::create(['playerID' => $playerID]);
//            }
//
//            return response('false', 200);
//        }
//
//        $return = $online->online;
//
//        if (!isset($request->withoutTouch)) {
//            $online->touch();
//        }
//        return response($return, 200);
    }
}

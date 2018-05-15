<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Online;
use Carbon\Carbon;

class OnlineController extends Controller
{
    public function __invoke(Request $request)
    {
        $online = Online::where(['googleID' => $request->googleID])->first();


        if (empty($online)) {

            if (!isset($request->withoutTouch)) {
                Online::create(['googleID' => $request->googleID]);
            }

            return response('false', 200);
        }

        if (!isset($request->withoutTouch)) {
            $online->touch();
        }
        return response($online->online, 200);
    }
}

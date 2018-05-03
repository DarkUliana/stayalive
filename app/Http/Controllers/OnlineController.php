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
            Online::create(['googleID' => $request->googleID]);
            return response('false', 200);
        }

        $now = new Carbon();
        $player = new Carbon($online->updated_at);
        $diff = $player->diffInSeconds($now, false);

        if ($diff < 30) {
            return response('true', 200);
        }

        $online->touch();
        return response('false', 200);
    }
}

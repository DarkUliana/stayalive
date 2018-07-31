<?php

namespace App\Http\Controllers;

use App\BanList;
use Illuminate\Http\Request;

class BanListController extends Controller
{
    public function __invoke(Request $request)
    {
        if (!isset($request->googleID)) {

            return response('Ivalid data!', 400);
        }

        if (BanList::where('googleID', $request->googleID)->first()) {

            return response(true, 200);
        }

        return response(false, 200);
    }
}

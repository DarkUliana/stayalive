<?php

namespace App\Http\Controllers;

use App\EventIsland;
use Illuminate\Http\Request;

class EventIslandController extends Controller
{
    public function __invoke()
    {
        $islands = EventIsland::all()->toArray();

        return response(['settingList' => $islands], 200);
    }
}

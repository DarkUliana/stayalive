<?php

namespace App\Http\Controllers;

use App\Mob;
use Illuminate\Http\Request;

class MobController extends Controller
{
    public function index()
    {
        $mobs = Mob::all()->toArray();

        return response(['baseStates' => $mobs], 200);
    }
}

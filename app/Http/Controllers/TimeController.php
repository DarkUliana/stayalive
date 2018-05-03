<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function index(Request $request)
    {
        return response(date('Y-m-d H:i:s'), 200);
    }
}

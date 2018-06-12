<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ReconnectController extends Controller
{
    public function __invoke(Request $request)
    {

        if (session('connection')) {

            session(['connection' => 0]);
        } else {


            session(['connection' => 1]);
        }

        return back();
    }
}

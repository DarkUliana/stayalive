<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CheckConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!session()->has('connection')) {

            session(['connection' => 0]);
        }

        if(Auth::user()->role) {
            if(!session('connection')) {

                Config::set("database.default", 'alive_test');
            }
        } else {

            session(['connection' => 0]);
            Config::set("database.default", 'alive_test');
        }

        return $next($request);
    }
}

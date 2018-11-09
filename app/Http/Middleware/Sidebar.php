<?php


namespace App\Http\Middleware;

use App\Http\Controllers\SidebarController;
use Closure;

class Sidebar
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
        \Illuminate\Support\Facades\View::share('sidebar', SidebarController::get());

        return $next($request);
    }

}
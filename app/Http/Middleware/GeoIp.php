<?php
/**
 * Created by PhpStorm.
 * User: Uliana
 * Date: 04.01.2019
 * Time: 11:01
 */

namespace App\Http\Middleware;


class GeoIp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, \Closure $next, $guard = null)
    {
        if (geoip_country_name_by_name($request->ip())) {

            abort(403);
        }

        return $next($request);
    }
}
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
        if (in_array(geoip_country_code_by_name($request->ip()), ['CN', 'TW'])) {

            abort(403, 'Error 403');
        }

        return $next($request);
    }
}
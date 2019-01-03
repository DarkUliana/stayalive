<?php
/**
 * Created by PhpStorm.
 * User: Uliana
 * Date: 03.01.2019
 * Time: 12:24
 */

namespace App\Http\Middleware;

use App\Player;
use App\PlayerIdentificator;
use App\PlayerIp;
use Closure;

class CheckPlayerIp
{
    public function handle($request, Closure $next)
    {
        if (isset($request->localID)) {

            $identificator = PlayerIdentificator::where('localID', $request->localID)->first();

            if ($identificator) {

                $player = Player::find($identificator->playerID);

                if ($player) {

                    if (!PlayerIp::where('playerID', $player->ID)->where('ip', $request->ip())->first()) {

                        PlayerIp::create(['playerID' => $player->ID, 'ip' => $request->ip()]);
                    }
                }
            }

        }

        return $next($request);

    }
}
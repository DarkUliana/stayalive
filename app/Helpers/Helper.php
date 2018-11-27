<?php

if (!function_exists('getPlayerID')) {

    function getPlayerID($localID) {

        $identificator = \App\PlayerIdentificator::where('localID', $localID)->first();

        if (empty($identificator)) {

            abort(404, 'player not found');
        }
        $player = \App\Player::find($identificator->playerID);

        if (empty($player)) {

            abort(404, 'player not found');
        }

        return $player->ID;
    }

    if (!function_exists('getQueryParams')) {

        function getQueryParams($request)
        {
            $params = '';
            if ($request->session()->has('itemsParams')) {

                $params ='?' . session('itemsParams');
            }

            return $params;

        }
    }
}
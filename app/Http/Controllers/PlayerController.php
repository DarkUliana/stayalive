<?php

namespace App\Http\Controllers;

use App\PlayerIdentificator;
use App\PlayerTraveledIsland;
use Illuminate\Http\Request;
use App\Player;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client as HttpClient;

class PlayerController extends Controller
{
    protected $noRename = ['isDeveloper', 'isDie', 'isSpawnInLocation', 'goldCoin', 'techCoin', 'keyCoin', 'collectedTechCoin', 'googleID', 'password', 'fromIsland', 'toIsland', 'inWalking', 'timeWalking'];

    public function get(Request $request)
    {
        $playerIdentificator = PlayerIdentificator::where('localID', $request->localID)->first();

        if (empty($playerIdentificator)) {
            return response('NULL', 404);
        }

        $player = $playerIdentificator->player;
        $playerRenamed = $this->renameAttributesBack($player->toArray());

        $playerRenamed['traveledIslands'] = PlayerTraveledIsland::where('playerID', $player->ID)->pluck('name');
        $playerRenamed['localID'] = $request->localID;

        return response($playerRenamed, 200);
    }

    public function post(Request $request)
    {
        if (!isset($request->localID)) {

            return response('Your request has no localID',400 );
        }

        $playerNamed = $this->renameAttributes($request->input());
        unset($playerNamed['traveledIslands']);
        unset($playerNamed['localID']);
        unset($playerNamed['ID']);


        $playerIdentificator = PlayerIdentificator::where('localID', $request->localID)->first();
        $playerID = '';

        $identification = 0;

        if (empty($playerIdentificator)) {

            $player = Player::create($playerNamed);
            $playerID = $player->ID;
            PlayerIdentificator::create(['localID' => $request->localID, 'playerID' => $playerID]);

            $params = [
                'localID' => $request->localID
            ];
            $client = new HttpClient();
            $client->request('POST', env('APP_URL').'/api/timer/tech', ['query' => $params]);
            $client->request('POST', env('APP_URL').'/api/timer/craft', ['query' => $params]);
            $client->request('POST', env('APP_URL').'/api/timer/walking', ['query' => $params]);
            $client->request('POST', env('APP_URL').'/api/timer/last-save', ['query' => $params]);
            $client->request('POST', env('APP_URL').'/api/timer/quest', ['query' => $params]);
        } else {

            if (isset($request->googleID)
                && $playerIdentificator->player->googleID != $request->googleID
                && !empty(Player::where('googleID', $request->googleID)->first())) {

                $playerByGoogleID = Player::where('googleID', $request->googleID)->first();

                $playerIdentificator->playerID = $playerByGoogleID->ID;
                $playerIdentificator->save();

                $playerIdentificator->player->touch();

                $identification = 1;
                //можливе видалення старих даних гравця

            } else {

                Player::where('ID', $playerIdentificator->playerID)->update($playerNamed);
            }


            $playerID = $playerIdentificator->playerID;
        }

        if (isset($request->traveledIslands)) {

            PlayerTraveledIsland::where('playerID', $playerID)->delete();

            foreach ($request->traveledIslands as $island) {

                PlayerTraveledIsland::create(['playerID' => $playerID, 'name' => $island]);
            }
        }


        return response($identification, 200);
    }

    protected function renameAttributes($array)
    {
        $renamed = [];
        foreach ($array as $key => $col) {
            $renamed[str_replace('player', '', $key)] = $col;
        }

        return $renamed;
    }

    protected function renameAttributesBack($array)
    {
        $renamed = [];


        foreach ($array as $key => $col) {

            if (in_array($key, $this->noRename)) {

                $renamed[$key] = $col;
            } else {

                $renamed['player' . $key] = $col;
            }

        }

        return $renamed;
    }

}

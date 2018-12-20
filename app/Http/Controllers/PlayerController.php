<?php

namespace App\Http\Controllers;

use App\BanList;
use App\CloudItem;
use App\PlayerIdentificator;
use App\PlayerTraveledIsland;
use App\Timer;
use Carbon\Carbon;
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

        if (empty($playerIdentificator) || empty($playerIdentificator->player)) {
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

            return response('Your request has no localID', 400);
        }

        $playerNamed = $this->renameAttributes($request->input());
        unset($playerNamed['traveledIslands']);
        unset($playerNamed['localID']);
        unset($playerNamed['ID']);


        $playerIdentificator = PlayerIdentificator::where('localID', $request->localID)->first();
        $playerID = '';

        $identification = 0;

        if (empty($playerIdentificator)) {


            if (isset($request->googleID) && !empty($request->googleID)) {

                $playerByGoogleID = Player::where('googleID', $request->googleID)->first();

                if ($playerByGoogleID) {

                    $playerID = $playerByGoogleID->ID;

                    $identification = 1;

                } else {

                    $playerID = $this->createPlayer($request, $playerNamed);

                }

            } else {

                $playerID = $this->createPlayer($request, $playerNamed);

            }
            PlayerIdentificator::create(['localID' => $request->localID, 'playerID' => $playerID]);


        } else {

            if (isset($request->googleID) && !empty($request->googleID)) {

                $playerByGoogleID = Player::where('googleID', $request->googleID)->first();

                if ($playerByGoogleID && $playerByGoogleID->ID != $playerIdentificator->playerID) {

                    $playerIdentificator->playerID = $playerByGoogleID->ID;
                    $playerIdentificator->save();

                    $playerIdentificator->player->touch();

                    $identification = 1;

                } else {

                    $this->checkData($playerNamed, $playerIdentificator->playerID);
                    Player::where('ID', $playerIdentificator->playerID)->update($playerNamed);
                }


            }
            else {

                $this->checkData($playerNamed, $playerIdentificator->playerID);
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

    protected function checkData($data, $playerID)
    {

        if (((CloudItem::where(['playerID' => $playerID, 'imageName' => 'goldCoinPurchase', 'isTaken' => 1])->sum('count') + 50) < $data['goldCoin'])
            || ((CloudItem::where(['playerID' => $playerID, 'imageName' => 'keyCoinPurchase', 'isTaken' => 1])->sum('count') + 5) < $data['keyCoin'])) {

            BanList::firstOrCreate(['playerID' => $playerID]);
        }
    }

    protected function createPlayer(Request $request, $playerNamed)
    {
        $player = Player::create($playerNamed);
        $playerID = $player->ID;

        foreach (['tech', 'craft', 'walking', 'last-save', 'quest'] as $type) {

            $data = [
                'playerID' => $playerID,
                'type' => $type,
                'start' => Carbon::now()
            ];

            Timer::create($data);
        }

//        $params = [
//            'localID' => $request->localID
//        ];

//        $client = new HttpClient();
//        $client->request('POST', env('APP_URL').'/api/timer/tech', ['query' => $params]);
//        $client->request('POST', env('APP_URL').'/api/timer/craft', ['query' => $params]);
//        $client->request('POST', env('APP_URL').'/api/timer/walking', ['query' => $params]);
//        $client->request('POST', env('APP_URL').'/api/timer/last-save', ['query' => $params]);
//        $client->request('POST', env('APP_URL').'/api/timer/quest', ['query' => $params]);

        return $playerID;
    }

}

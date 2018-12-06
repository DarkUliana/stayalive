<?php

namespace App\Http\Controllers;

use App\BanList;
use App\CloudItem;
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

        if (empty($playerIdentificator) || empty($playerIdentificator->player)) {
            return response('NULL', 404);
        }

        $player = $playerIdentificator->player;

        $playerRenamed = $this->renameAttributesBack($player->toArray());

        $playerRenamed['traveledIslands'] = PlayerTraveledIsland::where('playerID', $player->ID)->pluck('name');
        $playerRenamed['localID'] = $request->localID;

        return response($playerRenamed, 200);
    }

    /*

    I.  Якщо в $request немає localID повертає помилку 400

    II. Якщо даного в $request localID немає в таблиці player_identificators:

            1.  Якщо немає або пустий googleID в $request - створюється новий гравець і за ним закріплюється даний localID.

            2.  Якщо є googleID в $request і його немає в іншого гравця - створюється новий гравець і за ним
                закріплюється даний localID.

            3.  Якщо є googleID в $request і він є в іншого гравця - створюється запис в player_identificators,
                який закріплює даний localID до гравця з даним googleID.


    III.  Якщо запис з даним в $request localID є в таблиці player_identificators і немає або пустий googleID в $request -
        гравцю пишеться null в замість googleID в таблицю players.

    IV.   Якщо запис з даним в $request localID є в таблиці player_identificators і є googleID в $request:

            1.  Якщо в записі гравця в таблиці players немає googleID і не існує гравця з даним в $request
                googleID - гравцю в таблицю пишеться даний в $request googleID разом з даними з $request

            2.  Якщо даний в $request googleID дорівнює тому, що вже є в гравця - йому пишуться дані з $request

            3.  Якщо в гравця вже є googleID і даний в $request googleID відрізняється від нього:

                    а) якщо гравець з даним в $request googleID вже існує - даний в $request localID закріплюється за
                       гравцем з даним в $request googleID

                    б) якщо гравець з даним в $request googleID не існує - створюється новий гравець з даними з $request,
                       а даний в $request localID закріплюється за цим новим гравцем


     */

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

        if ($playerIdentificator == null) { //якщо localID не зареєстрована в базі

            if (!isset($request->googleID) || empty($request->googleID) ||  // якщо googleID немає або він пустий або гравця з таким googleID не існує
                Player::where('googleID', $request->googleID)->first() == null) {

                $playerID = $this->createPlayer($request, $playerNamed);

            } else {

                PlayerIdentificator::create(['localID' => $request->localID, 'playerID' => $playerID]);

            }
        } else { //якщо localID зареєстрована в базі

            if (!isset($request->googleID)) { // якщо googleID немає

                $this->checkData($playerNamed, $playerIdentificator->playerID);
                Player::where('ID', $playerIdentificator->playerID)->update($playerNamed);


            } else { // якщо googleID є

                if (empty($request->googleID || $request->googleID == $playerIdentificator->player->googleID)) { // якщо googleID пустий або дорівнює тому googleID, що вже є в гравця, до якого привязаний даний localID

                    $this->checkData($playerNamed, $playerIdentificator->playerID);
                    Player::where('ID', $playerIdentificator->playerID)->update($playerNamed);

                } else {

                    $playerByGoogleID = Player::where('googleID', $request->googleID)->first();

                    if ($playerByGoogleID == null) { //якщо гравця з даним googleID не існує

                        if ($playerIdentificator->player->googleID == null) { //якщо в даного гравця немає googleID

                            $this->checkData($playerNamed, $playerIdentificator->playerID);
                            Player::where('ID', $playerIdentificator->playerID)->update($playerNamed);

                        } else { //якщо в даного гравця є googleID

                            $this->createPlayer($request, $playerNamed);
                        }


                    } else { //якщо гравець з даним googleID існує

                        $playerIdentificator->playerID = $playerByGoogleID->ID;
                        $playerIdentificator->save();

                        $playerIdentificator->player->touch();
                        $playerID = $playerByGoogleID->ID;
                        $identification = 1;
                    }

                }
            }

            if (isset($request->traveledIslands)) {

                PlayerTraveledIsland::where('playerID', $playerID)->delete();

                foreach ($request->traveledIslands as $island) {

                    PlayerTraveledIsland::create(['playerID' => $playerID, 'name' => $island]);
                }
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

        return $playerID;
    }

}

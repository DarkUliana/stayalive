<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Player;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client as HttpClient;

class PlayerController extends Controller
{
    protected $noRename = ['isDie', 'isSpawnInLocation', 'goldCoin', 'techCoin', 'googleID', 'password', 'fromIsland', 'toIsland', 'inWalking', 'timeWalking'];

    public function show(Request $request)
    {
        $player = Player::where('googleID', $request->googleID)->first();

        if(empty($player)) {
            return response('NULL', 404);
        }

        $playerRenamed = $this->renameAttributesBack($player->toArray());

        return response($playerRenamed, 200);
    }

    public function store(Request $request)
    {
        $playerNamed = $this->renameAttributes($request->input());
        if (isset($playerNamed['ID'])) {
            unset($playerNamed['ID']);
        }

//        $playerNamed['password'] = Hash::make($playerNamed['password']);

        $id = $playerNamed['googleID'];
        unset($playerNamed['googleID']);
        $player = Player::updateOrCreate(['googleID' => $id], $playerNamed);

        if ($player->wasRecentlyCreated === true) {

            $params = [
                'googleID' => $player->googleID
            ];
            $client = new HttpClient();
            $client->request('POST', env('APP_URL').'/api/timer/tech', ['query' => $params]);
            $client->request('POST', env('APP_URL').'/api/timer/craft', ['query' => $params]);
            $client->request('POST', env('APP_URL').'/api/timer/walking', ['query' => $params]);
            $client->request('POST', env('APP_URL').'/api/timer/last-save', ['query' => $params]);
        }

        return response('ok', 200);
    }

    public function delete(Request $request)
    {
        Player::where('googleID', $request->googleID)->delete();

        return response(204);
    }

    protected function renameAttributes($array)
    {
        $renamed = [];
        foreach($array as $key => $col) {
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

                $renamed['player'.$key] = $col;
            }

        }
//        var_dump($renamed); die();
        return $renamed;
    }


}

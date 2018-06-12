<?php

namespace App\Http\Controllers;

use App\BasePlayer;
use App\Http\Resources\BasePlayerCollection;
use Illuminate\Http\Request;


class BasePlayerController extends Controller
{
    public function index()
    {
        return response(new BasePlayerCollection(BasePlayer::all()), 200);
    }

    public function store(Request $request)
    {

        if(!isset($request->basePlayer)) {

            return response('Invalid data!', 400);
        }

        BasePlayer::truncate();

        foreach ($request->basePlayer as $key => $value) {

            $data = [

                'property' => $key,
                'type' => gettype($value),
                'value' => $value
            ];
            BasePlayer::create($data);
        }

        return response('ok', 200);

    }
}

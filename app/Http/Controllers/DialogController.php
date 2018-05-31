<?php

namespace App\Http\Controllers;

use App\Dialog;
use App\Http\Resources\DialogCollection;
use Illuminate\Http\Request;

class DialogController extends Controller
{
    public function __invoke()
    {
        $beginQuestDialogs = Dialog::whereHas('quest', function ($q) {

            $q->where('daily', 0)->where('typeID', '<>', 8);
        })->get();

        $additionalDialogs = Dialog::whereHas('quest', function ($q) {

            $q->where('daily', 0)->where('typeID', 8);
        })->get();

        $array = [
            'beginQuestDialogs' => new DialogCollection($beginQuestDialogs),
            'additionalDialogs' => new DialogCollection($additionalDialogs)
        ];

        return response($array, 200);
    }
}

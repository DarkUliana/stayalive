<?php

namespace App\Http\Controllers;

use App\Dialog;
use App\DialogDescription;
use App\Http\Resources\DialogCollection;
use Illuminate\Http\Request;

class DialogController extends Controller
{
    public function index()
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

    public function store(Request $request)
    {
        if(!isset($request->beginQuestDialogs) or !isset($request->AdditionalDialogs)) {
            return response('Invalid data', 400);
        }

        Dialog::truncate();
        DialogDescription::truncate();


    }
}

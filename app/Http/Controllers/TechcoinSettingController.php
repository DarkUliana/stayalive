<?php

namespace App\Http\Controllers;

use App\TechcoinSetting;
use Illuminate\Http\Request;

class TechcoinSettingController extends Controller
{
    public function get()
    {
        $settings = TechcoinSetting::all();

        $return = [];

        foreach ($settings as $setting)
        {
            $return[$setting->property] = $setting->value;
        }

        return response($return, '200');
    }

    public function post()
    {

    }
}

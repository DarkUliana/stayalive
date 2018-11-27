<?php

namespace App\Http\Controllers;

use App\QuestDescription;
use Illuminate\Http\Request;

class QuestDescriptionController extends Controller
{
    public function __invoke()
    {
        $descriptions = QuestDescription::all();

        $return = [];

        foreach ($descriptions as $description) {

            $return[$description->questID]['questID'] = $description->questID;
            $return[$description->questID]['descriptions'][] = $description;
        }

        return response(['questDescriptions' => array_values($return)], 200);

    }
}

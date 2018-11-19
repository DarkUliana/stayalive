<?php

namespace App\Http\Controllers;

use App\QuestDescription;
use Illuminate\Http\Request;

class QuestDescriptionController extends Controller
{
    public function __invoke()
    {
        $descriptions = QuestDescription::all();
        $grouped = $descriptions->groupBy('questID');

        $return = [];

        foreach ($grouped as $key => $item) {

            $return['questDescriptions'][] = [
                'questID' => $key,
                'descriptions' => $item
            ];
        }
        return $return;

    }
}

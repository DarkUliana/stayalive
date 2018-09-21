<?php

namespace App\Http\Controllers;

use App\QuestSequence;
use Illuminate\Http\Request;

class QuestSequenceController extends Controller
{
    public function get()
    {
        $sequences = QuestSequence::all();

        $data = [];

        foreach ($sequences as $sequence) {

            $quests = $sequence->quests()->pluck('questID')->toArray();
            $temp = $sequence->toArray();
            $temp['questsIDs'] = $quests;
            $data[] = $temp;
        }

        return response(['questSequences' => $data], 200);
    }
}

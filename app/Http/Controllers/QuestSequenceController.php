<?php

namespace App\Http\Controllers;

use App\DiaryStorageNote;
use Illuminate\Http\Request;

class QuestSequenceController extends Controller
{
    public function get()
    {
        $sequences = DiaryStorageNote::all();

        $data = [];

        foreach ($sequences as $sequence) {

            $quests = $sequence->quests()->pluck('questID')->toArray();
            $temp = [
                'ID' => $sequence->ID,
                'noteID' => $sequence->noteID
            ];
            $temp['questsIDs'] = $quests;
            $data[] = $temp;
        }

        return response(['questSequences' => $data], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\PlayerIdentificator;
use App\PlayerRepairItem;
use App\PlayerRepairItemPart;
use App\PlayerRestorableObject;
use App\PlayerRestorableObjectSlot;
use Illuminate\Http\Request;
use App\Player;
use Illuminate\Support\Facades\DB;

class MovingOneOldPlayer extends Controller
{
    protected $tablesWithGoogleID = [

        'cloud_items',
        'equipment',
        'inventory',
        'items_in_craft',
        'online',
        'player_body_positions',
        'player_body_slots',
        'player_building_technologies',
        'player_chest_items',
        'player_diary_notes',
        'player_learned_recipes',
        'player_quests',
        'player_quest_replacements',
        'player_restorable_objects',
        'player_rewards',
        'player_sequences',
        'player_technologies_states',
        'player_traveled_islands',
        'timers',
        'unity_logs'
    ];

    protected $tablesWithPlayerID = [
        'player_pref_records',
        'player_repair_items',
        'player_ship_chests',
        'player_ship_stuff_items',
        'player_technology_quantities'
    ];


    public function __invoke($googleID)
    {
        $oldDB = 'stay-alive';
        $oldPlayer = Player::on($oldDB)->where('googleID', $googleID)->first();

//        dd($oldPlayer);

        if ($oldPlayer == null) {

            abort(404);
        }

        if (Player::where('googleID', $googleID)->first() != null) {

            Player::where('googleID', $googleID)->delete();
        }

        $newPlayer = Player::create($oldPlayer->toArray());
        PlayerIdentificator::create(['localID' => $googleID, 'playerID' => $newPlayer->ID]);

        foreach (array_merge($this->tablesWithPlayerID, $this->tablesWithGoogleID) as $table) {

            $id = 'googleID';

            if (in_array($table, $this->tablesWithPlayerID)) {

                $id = 'playerID';
            }

            if ($table == 'player_restorable_objects') {

                $data = PlayerRestorableObject::on($oldDB)->where($id, $googleID)->get();
                foreach ($data as $obj) {

                    $item = $obj->toArray();
                    unset($item['googleID']);
                    $item['playerID'] = $newPlayer->ID;
                    $newObj = PlayerRestorableObject::create($item);

                    foreach ($obj['slots'] as $slot) {

                        $slotData = $slot->toArray();
                        $newSlot =  new PlayerRestorableObjectSlot($slotData);

                        $newObj->slots()->save($newSlot);
                    }

                }

            } elseif ($table == 'player_repair_items') {


                $data = PlayerRepairItem::on($oldDB)->where($id, $googleID)->get();
                foreach ($data as $item) {

                    $item = $item->toArray();
                    unset($item['googleID']);
                    $item['playerID'] = $newPlayer->ID;
                    $newObj = PlayerRepairItem::create($item);

                    foreach ($item['parts'] as $part) {

                        $partData = $part->toArray();
                        $newPart = new PlayerRepairItemPart($partData);

                        $newObj->parts()->save($newPart);

                    }
                }


            } else {

                $data = DB::connection($oldDB)->table($table)->where($id, $googleID)->get();
                foreach ($data as $one) {

                    $item = json_decode(json_encode($one), true);
                    unset($item['ID']);
                    unset($item['googleID']);
                    $item['playerID'] = $newPlayer->ID;

                    DB::table($table)->insert($item);

                }
            }

        }
        return response($newPlayer->ID, 200);
    }
}

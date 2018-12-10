<?php

use Illuminate\Database\Seeder;
use App\Player;
use App\PlayerIdentificator;
use Illuminate\Support\Facades\DB;
use App\PlayerPrefRecord;

class NewPlayerIdentificatorsSeeder extends Seeder
{
    protected $tables = [
        'ban_list',
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
        'unity_logs',
    ];
    protected $tablesWithPlayerID = [
        'player_pref_records',
        'player_repair_items',
        'player_ship_chests',
        'player_ship_stuff_items',
        'player_technology_quantities'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Player::orderBy('ID')->chunk(100, function ($players) {

            foreach ($players as $player) {

                PlayerIdentificator::create(['playerID' => $player->ID, 'localID' => $player->googleID]);
            }
        });



        foreach (array_merge($this->tables, $this->tablesWithPlayerID) as $table) {


            $key = 'googleID';
            if (in_array($table, $this->tablesWithPlayerID)) {

                $key = 'playerID';
            }



            $googleIDs = DB::table($table)->select("$key as googleID")->distinct()->get();

            foreach ($googleIDs as $googleID) {

                $player = Player::where('googleID', $googleID->googleID)->first();

                if (empty($player)) {

                    DB::table($table)->where($key, $googleID->googleID)->delete();


                } else {

                    $tutorial = [
                        'playerID' => $player->ID,
                        'prefType' => 2,
                        'prefKey' => 'TutorialData',
                        'prefValue' => '{"isComplete":true,"tutorialStep":4194304,"tutorialStage":9}'
                    ];
                    PlayerPrefRecord::create($tutorial);

                    DB::table($table)->where($key, $googleID->googleID)->update([$key => $player->ID]);

                }

            }

        }

    }
}

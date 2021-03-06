<?php

use Illuminate\Database\Seeder;
use App\Player;
use App\PlayerIdentificator;
use Illuminate\Support\Facades\DB;
use App\PlayerPrefRecord;
use App\PlayerRestorableObject;
use App\PlayerRestorableObjectSlot;

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

        DB::table('player_sequences')->truncate();
        DB::table('player_quests')->truncate();

//        $this->command->info('Deleting player restorable slots');
//
//        $playerRestorableObjectsIDs = \App\PlayerRestorableObject::pluck('ID');
//
//        PlayerRestorableObjectSlot::whereNotIn('restorableObjectID', PlayerRestorableObject::pluck('ID')->toArray())->delete();
//
//        foreach ($playerRestorableObjectsIDs as $playerRestorableObjectsID) {
//
//            $this->command->info($playerRestorableObjectsID);
//            \App\PlayerRestorableObjectSlot::where('restorableObjectID', $playerRestorableObjectsID)->orderBy('ID')->limit(6)->delete();
//        }

        $this->command->info('Updating playerID');

        foreach (array_merge($this->tables, $this->tablesWithPlayerID) as $table) {

            $this->command->info($table);

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

                    $this->command->info($table . ' ' . $player->ID);
                    DB::table($table)->where($key, $googleID->googleID)->update([$key => $player->ID]);

                }

            }

        }

        Player::orderBy('ID')->chunk(100, function ($players) {

            $this->command->info('Seeding sequences, quests and tutorial');

            foreach ($players as $player) {

                $this->command->info('Seeding sequences, quests, identificators and tutorial' . $player->ID);

                PlayerIdentificator::create(['playerID' => $player->ID, 'localID' => $player->googleID]);


                DB::table('player_sequences')->insert([
                    ['googleID' => $player->ID, 'sequenceID' => 1, 'state' => 1],
                    ['googleID' => $player->ID, 'sequenceID' => 2, 'state' => 1],
                    ['googleID' => $player->ID, 'sequenceID' => 4, 'state' => 1],
                    ['googleID' => $player->ID, 'sequenceID' => 6, 'state' => 0]
                ]);

                DB::table('player_quests')->insert([
                    'googleID' => $player->ID,
                    'type' => 'plot',
                    'progress' => 0,
                    'questID' => 2

                ]);

                PlayerPrefRecord::create([
                    'playerID' => $player->ID,
                    'prefType' => 2,
                    'prefKey' => 'TutorialData',
                    'prefValue' => '{"isComplete":true,"tutorialStep":4194304,"tutorialStage":9}'
                ]);
            }
        });

    }
}

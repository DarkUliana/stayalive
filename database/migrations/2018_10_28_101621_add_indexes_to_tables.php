<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIndexesToTables extends Migration
{
    protected $tablesWithGoogleID = [
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
        'unity_logs'
    ];

    protected $tablesWithPlayerID = [
        'player_pref_records',
        'player_repair_items',
        'player_ship_chests',
        'player_ship_stuff_items',
        'player_technology_quantities'
    ];

    protected $tablesWithEnum = [
        'player_quests',
        'timers'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->tablesWithGoogleID as $table) {

            DB::Statement("ALTER TABLE $table CHANGE googleID googleID VARCHAR(191) NOT NULL");
            DB::Statement("ALTER TABLE $table ADD INDEX " . $table . "_playerID (googleID)");

        }

        foreach ($this->tablesWithPlayerID as $table) {

            DB::Statement("ALTER TABLE $table CHANGE playerID playerID VARCHAR(191) NOT NULL");
            DB::Statement("ALTER TABLE $table ADD INDEX " . $table . "_playerID (playerID)");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

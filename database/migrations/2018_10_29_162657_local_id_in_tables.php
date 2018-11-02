<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class LocalIdInTables extends Migration
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

        Artisan::call('db:seed', ['--class' => 'NewPlayerIdentificatorsSeeder']);

        foreach ($this->tablesWithGoogleID as $table) {

            if (in_array($table, $this->tablesWithEnum)) {
                DB::Statement("ALTER TABLE $table CHANGE googleID playerID INT NOT NULL");

            } else {

                Schema::table($table, function (Blueprint $t) {
                    $t->renameColumn('googleID', 'playerID');
                });
            }

        }

        foreach (array_merge($this->tablesWithGoogleID, $this->tablesWithPlayerID) as $table) {

            if (!in_array($table, $this->tablesWithEnum)) {
                Schema::table($table, function (Blueprint $t) {

                    $t->integer('playerID')->change();
                });
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (array_merge($this->tablesWithGoogleID, $this->tablesWithPlayerID) as $table) {

            Schema::table($table, function (Blueprint $table) {

                $table->string('playerID')->change();
            });
        }

        foreach ($this->tablesWithGoogleID as $table) {

            Schema::table($table, function (Blueprint $t) {
                $t->renameColumn('playerID', 'googleID');
            });
        }
    }
}

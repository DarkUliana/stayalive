<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BigInteger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cloud_items', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('items_in_craft', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_body_positions', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_building_technologies', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_diary_notes', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_learned_recipes', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_pref_records', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        DB::Statement('ALTER TABLE player_quests MODIFY COLUMN ID BIGINT AUTO_INCREMENT');

        Schema::table('player_quest_replacements', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_repair_items', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_repair_items', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_repair_item_parts', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
            $table->bigInteger('repairItemID')->change();
        });

        Schema::table('player_restorable_object_slots', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_rewards', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_ship_stuff_items', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_technology_quantities', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        Schema::table('player_traveled_islands', function (Blueprint $table) {
            $table->bigIncrements('ID')->change();
        });

        DB::Statement('ALTER TABLE timers MODIFY COLUMN ID BIGINT AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cloud_items', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('items_in_craft', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_body_positions', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_building_technologies', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_diary_notes', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_learned_recipes', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_pref_records', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        DB::Statement('ALTER TABLE player_quests MODIFY COLUMN ID INT AUTO_INCREMENT');

        Schema::table('player_quest_replacements', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_repair_items', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_repair_items', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_repair_item_parts', function (Blueprint $table) {
            $table->increments('ID')->change();
            $table->integer('repairItemID')->change();
        });

        Schema::table('player_restorable_object_slots', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_rewards', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_ship_stuff_items', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_technology_quantities', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        Schema::table('player_traveled_islands', function (Blueprint $table) {
            $table->increments('ID')->change();
        });

        DB::Statement('ALTER TABLE timers MODIFY COLUMN ID INT AUTO_INCREMENT');;

    }
}

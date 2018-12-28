<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NullableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_event_locations', function (Blueprint $table) {

            $table->string('conditionName')->nullable()->change();
            $table->string('locationName')->nullable()->change();
            $table->string('timeInitializing')->nullable()->change();
            $table->string('timeRaising')->nullable()->change();
        });

        Schema::table('player_event_conditions', function (Blueprint $table) {

            $table->string('conditionName')->nullable()->change();
            $table->string('timeFirstInitialization')->nullable()->change();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('player_event_locations', function (Blueprint $table) {

            $table->string('conditionName')->change();
            $table->string('locationName')->change();
            $table->string('timeInitializing')->change();
            $table->string('timeRaising')->change();
        });

        Schema::table('player_event_conditions', function (Blueprint $table) {

            $table->string('conditionName')->change();
            $table->string('timeFirstInitialization')->change();
        });
    }
}

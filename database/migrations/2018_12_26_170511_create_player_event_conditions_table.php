<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerEventConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_event_conditions', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->integer('playerID');
            $table->integer('eventLocationsType');
            $table->string('conditionName');
            $table->string('timeFirstInitialization');
            $table->integer('raisedCount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_event_conditions');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerEventLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_event_locations', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->integer('playerID');
            $table->integer('eventLocationsType');
            $table->string('conditionName');
            $table->string('locationName');
            $table->string('timeInitializing');
            $table->string('timeRaising');
            $table->boolean('needToRaise');
            $table->boolean('isRaised');
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
        Schema::dropIfExists('player_event_locations');
    }
}

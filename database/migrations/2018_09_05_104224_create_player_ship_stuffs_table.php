<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerShipStuffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_ship_stuffs', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('playerID');
            $table->integer('floorIndex');
            $table->integer('cellIndex');
            $table->integer('cellType');
            $table->integer('technologyType');
            $table->integer('techLevel');
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
        Schema::dropIfExists('player_ship_stuffs');
    }
}

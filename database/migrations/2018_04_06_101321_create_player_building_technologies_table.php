<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerBuildingTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_building_technologies', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('googleID');
            $table->boolean('inBuilding')->nullable();
            $table->unsignedInteger('idCurrentBuildingTech')->nullable();
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
        Schema::dropIfExists('player_building_technologies');
    }
}

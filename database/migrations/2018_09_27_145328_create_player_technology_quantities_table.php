<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerTechnologyQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_technology_quantities', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('playerID');
            $table->integer('itemType');
            $table->integer('itemCount');
            $table->integer('itemCountMax');
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
        Schema::dropIfExists('player_technology_quantities');
    }
}

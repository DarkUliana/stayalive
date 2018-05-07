<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerTechnologiesStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_technologies_states', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('googleID');
            $table->unsignedInteger('technologyID');
            $table->tinyInteger('technologyState');
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
        Schema::dropIfExists('player_technologies_states');
    }
}

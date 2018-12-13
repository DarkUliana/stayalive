<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerEnemySavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_enemy_saves', function (Blueprint $table) {
            $table->BigIncrements('ID');
            $table->integer('playerID');
            $table->string('enemyName');
            $table->integer('enemyType');
            $table->integer('enemyLevel');
            $table->integer('countInScene');
            $table->string('lootKey')->nullable();
            $table->float('chanceToSelect');
            $table->float('chanceToInstatiate');
            $table->boolean('enemyDead');
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
        Schema::dropIfExists('player_enemy_saves');
    }
}

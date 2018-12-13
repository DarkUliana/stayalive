<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSceneEnemyItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scene_enemy_items', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('sceneEnemyID');
            $table->integer('enemyType');
            $table->integer('enemyLevel');
            $table->integer('countInScene');
            $table->string('lootKey')->nullable();
            $table->float('chanceToSelect');
            $table->float('chanceToInstatiate');
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
        Schema::dropIfExists('scene_enemy_items');
    }
}

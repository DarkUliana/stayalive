<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mobs', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('enemyType');
            $table->integer('enemyLevel');
            $table->integer('maximumHP');
            $table->double('playerDetectRadius');
            $table->double('callRadius');
            $table->double('addAgroRadius');
            $table->double('attackCloseRange');
            $table->integer('attackClosePower');
            $table->double('attackCloseRate');
            $table->integer('giveExpirience');
            $table->double('movementSpeed');
            $table->double('timeToStay');
            $table->double('increaseSpeedRange');
            $table->double('increaseSpeedValue');
            $table->double('increaseSpeedTime');
            $table->double('attackDistanceRange');
            $table->integer('attackDistancePower');
            $table->double('attackDistanceRate');
            $table->double('attackSpeedDecrease');
            $table->double('movementSpeedDecrease');
            $table->double('timeDebuff');
            $table->double('chance');
            $table->double('hillRange');
            $table->integer('hillPower');
            $table->double('hillRate');
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
        Schema::dropIfExists('mobs');
    }
}

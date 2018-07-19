<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class AddDefaultValuesToMobsTable extends Migration
{
    protected $table = 'mobs';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->table, function (Blueprint $table) {
            $table->integer('enemyType')->default(0)->change();
            $table->integer('enemyLevel')->default(0)->change();
            $table->integer('maximumHP')->default(0)->change();
            $table->float('playerDetectRadius')->default(0)->change();
            $table->float('callRadius')->default(0)->change();
            $table->float('addAgroRadius')->default(0)->change();
            $table->float('attackCloseRange')->default(0)->change();
            $table->integer('attackClosePower')->default(0)->change();
            $table->float('attackCloseRate')->default(0)->change();
            $table->integer('giveExpirience')->default(0)->change();
            $table->float('movementSpeed')->default(0)->change();
            $table->float('timeToStay')->default(0)->change();
            $table->float('increaseSpeedRange')->default(0)->change();
            $table->float('increaseSpeedValue')->default(0)->change();
            $table->float('increaseSpeedTime')->default(0)->change();
            $table->float('attackDistanceRange')->default(0)->change();
            $table->integer('attackDistancePower')->default(0)->change();
            $table->float('attackDistanceRate')->default(0)->change();
            $table->float('attackSpeedDecrease')->default(0)->change();
            $table->float('movementSpeedDecrease')->default(0)->change();
            $table->float('timeDebuff')->default(0)->change();
            $table->float('chance')->default(0)->change();
            $table->float('hillRange')->default(0)->change();
            $table->integer('hillPower')->default(0)->change();
            $table->float('hillRate')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->table, function (Blueprint $table) {
            $table->integer('enemyType')->change();
            $table->integer('enemyLevel')->change();
            $table->integer('maximumHP')->change();
            $table->float('playerDetectRadius')->change();
            $table->float('callRadius')->change();
            $table->float('addAgroRadius')->change();
            $table->float('attackCloseRange')->change();
            $table->integer('attackClosePower')->change();
            $table->float('attackCloseRate')->change();
            $table->integer('giveExpirience')->change();
            $table->float('movementSpeed')->change();
            $table->float('timeToStay')->change();
            $table->float('increaseSpeedRange')->change();
            $table->float('increaseSpeedValue')->change();
            $table->float('increaseSpeedTime')->change();
            $table->float('attackDistanceRange')->change();
            $table->integer('attackDistancePower')->change();
            $table->float('attackDistanceRate')->change();
            $table->float('attackSpeedDecrease')->change();
            $table->float('movementSpeedDecrease')->change();
            $table->float('timeDebuff')->change();
            $table->float('chance')->change();
            $table->float('hillRange')->change();
            $table->integer('hillPower')->change();
            $table->float('hillRate')->change();
        });
    }
}

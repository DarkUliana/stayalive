<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFloorRecoversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floor_recovers', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->integer('playerID');
            $table->integer('shipStuffID');
            $table->boolean('floorRecover');
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
        Schema::dropIfExists('floor_recovers');
    }
}

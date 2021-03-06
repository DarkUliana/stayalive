<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerShipChestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_ship_chest_items', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('playerShipChestID');
            $table->integer('Index')->nullable();
            $table->integer('CurrentCount')->nullable();
            $table->float('currentDurability')->nullable();
            $table->boolean('available')->nullable();
            $table->integer('SlotType')->nullable();
            $table->integer('itemID')->nullable();
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
        Schema::dropIfExists('player_ship_chest_items');
    }
}

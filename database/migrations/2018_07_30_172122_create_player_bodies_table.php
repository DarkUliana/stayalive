<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerBodiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players_bodies', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('ID');
            $table->string('googleID');
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
        Schema::dropIfExists('players_bodies');
    }
}

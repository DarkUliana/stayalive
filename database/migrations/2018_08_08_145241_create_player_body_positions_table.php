<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerBodyPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_body_positions', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('googleID');
            $table->float('x');
            $table->float('y');
            $table->float('z');
            $table->string('sceneName');
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
        Schema::dropIfExists('player_body_positions');
    }
}

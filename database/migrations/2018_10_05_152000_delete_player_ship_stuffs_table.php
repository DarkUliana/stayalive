<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeletePlayerShipStuffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('player_ship_stuffs');

        Schema::table('player_ship_stuff_items', function (Blueprint $table) {
            $table->string('playerID')->after('ID');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('player_ship_stuff_items', function (Blueprint $table) {
            $table->dropColumn('playerID');
        });
    }
}

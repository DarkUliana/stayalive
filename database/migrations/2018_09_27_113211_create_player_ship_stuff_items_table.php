<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use App\PlayerShipStuff;

class CreatePlayerShipStuffItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_ship_stuff_items', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('stuffID');
            $table->integer('cellIndex');
            $table->integer('cellType');
            $table->integer('technologyType');
            $table->integer('techLevel');
            $table->timestamps();
        });

        Schema::table('player_ship_stuffs', function (Blueprint $table) {
            $table->dropColumn('cellIndex');
            $table->dropColumn('cellType');
            $table->dropColumn('technologyType');
            $table->dropColumn('techLevel');
            $table->integer('deckWidth')->after('floorIndex');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_ship_stuff_items');

        Schema::table('player_ship_staffs', function (Blueprint $table) {

            $table->integer('cellIndex')->after('floorIndex');
            $table->integer('cellType')->after('floorIndex');
            $table->integer('technologyType')->after('floorIndex');
            $table->integer('techLevel')->after('floorIndex');
            $table->dropColumn('deckWidth');
        });
    }
}

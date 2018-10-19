<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDirFieldToShipStuffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ship_stuff_items', function (Blueprint $table) {

            $table->integer('dir')->after('techLevel')->default(0);
        });

        Schema::table('player_ship_stuff_items', function (Blueprint $table) {

            $table->integer('dir')->after('techLevel')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ship_stuff_items', function (Blueprint $table) {

            $table->dropColumn('dir');
        });

        Schema::table('player_ship_stuff_items', function (Blueprint $table) {

            $table->dropColumn('dir');
        });
    }
}

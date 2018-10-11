<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeOfTechnologyType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('player_ship_stuff_items', function (Blueprint $table) {

           $table->bigInteger('technologyType')->change();
        });

        Schema::table('ship_stuff_items', function (Blueprint $table) {

           $table->bigInteger('technologyType')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}

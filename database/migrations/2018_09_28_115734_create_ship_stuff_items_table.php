<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipStuffItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_stuff_items', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('stuffID');
            $table->integer('cellIndex');
            $table->integer('cellType');
            $table->integer('technologyType');
            $table->integer('techLevel');
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
        Schema::dropIfExists('ship_stuff_items');
    }
}

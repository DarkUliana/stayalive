<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsInCraftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_in_craft', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('googleID');
            $table->integer('countToCraft');
            $table->integer('timeToCraft');
            $table->integer('itemID');
            $table->tinyInteger('type');
            $table->integer('coinCost');
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
        Schema::dropIfExists('items_in_craft');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTechnologyOppenedItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technology_oppened_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('technologyID');
            $table->unsignedInteger('itemID');
            $table->foreign('technologyID')
                ->references('ID')->on('technologies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technology_oppened_items');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('ID');
            $table->unsignedInteger('ItemID');
            $table->integer('recipeType');
            $table->string('Name');
            $table->float('CraftTime');
            $table->integer('Level');
            $table->integer('tmpComponentsSize');
            $table->integer('componentsSize');
            $table->integer('tmpBuildingsSize');
            $table->integer('BuildingsSize');
            $table->string('Type');
            $table->integer('InStack')->nullable();
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
        Schema::dropIfExists('recipes');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_technologies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('recipeID');
            $table->unsignedInteger('technologyID');
            $table->foreign('recipeID')
                ->references('ID')->on('recipes')
                ->onDelete('cascade');
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
        Schema::dropIfExists('recipe_technologies');
    }
}

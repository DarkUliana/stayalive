<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialSaveDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorial_save_data', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->integer('playerID');
            $table->tinyInteger('isComplete');
            $table->integer('tutorialStep');
            $table->integer('tutorialStage');
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
        Schema::dropIfExists('tutorial_save_data');
    }
}

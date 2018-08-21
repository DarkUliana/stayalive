<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayerDiaryNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_diary_notes', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('googleID');
            $table->integer('noteID');
            $table->integer('noteState');
            $table->integer('noteType');
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
        Schema::dropIfExists('player_diary_notes');
    }
}

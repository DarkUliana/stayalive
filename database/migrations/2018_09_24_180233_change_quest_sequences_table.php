<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeQuestSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('quest_sequences');

        Schema::rename('quest_sequence_quests', 'quest_sequences');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('quest_sequences', 'quest_sequence_quests');

        Schema::create('quest_sequences', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('noteID');
            $table->timestamps();
        });
    }
}

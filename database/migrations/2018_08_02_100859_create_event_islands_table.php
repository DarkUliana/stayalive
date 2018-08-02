<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventIslandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_islands', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('locationName');
            $table->float('frequencyOfOccurrence');
            $table->float('lifetime');
            $table->float('probabilityOfAppearance');
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
        Schema::dropIfExists('event_islands');
    }
}

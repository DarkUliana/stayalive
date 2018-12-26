<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventLocationSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_location_settings', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('locationID');
            $table->string('eventLocationName');
            $table->double('lifeTime');
            $table->double('chanceToEvent');
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
        Schema::dropIfExists('event_location_settings');
    }
}

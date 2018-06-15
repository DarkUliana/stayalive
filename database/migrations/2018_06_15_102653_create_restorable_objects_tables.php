<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestorableObjectsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restorable_objects', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->string('objectKey');
            $table->string('googleID');
            $table->timestamps();
        });
        Schema::create('restorable_object_slots', function (Blueprint $table) {
            $table->increments('ID');
            $table->bigInteger('restorableObjectID');
            $table->string('itemID');
            $table->integer('Index');
            $table->integer('CurrentCount');
            $table->integer('currentDurability');
            $table->boolean('available');
            $table->integer('SlotType');
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
        Schema::dropIfExists('restorable_objects');
        Schema::dropIfExists('restorable_object_slots');
    }
}

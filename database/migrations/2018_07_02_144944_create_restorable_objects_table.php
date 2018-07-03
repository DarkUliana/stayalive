<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestorableObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restorable_objects', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('restorable_object_items', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('restorableObjectID');
            $table->integer('ItemID');
            $table->integer('RequiredCount');
            $table->boolean('isTopList');
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
        Schema::dropIfExists('restorable_object_items');
    }
}

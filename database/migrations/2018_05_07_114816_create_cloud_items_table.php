<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCloudItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cloud_items', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('googleID');
            $table->string('uniqueID')->unique();
            $table->string('sourceID');
            $table->string('imageName');
            $table->boolean('inStuck');
            $table->integer('count');
            $table->boolean('isTaken');
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
        Schema::dropIfExists('cloud_items');
    }
}

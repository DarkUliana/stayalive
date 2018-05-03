<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('ID');
            $table->integer('googleID')->unsigned();
            $table->integer('Index')->nullable();
            $table->integer('CurrentCount')->nullable();
            $table->float('currentDurability')->nullable();
            $table->boolean('available')->nullable();
            $table->integer('SlotType')->nullable();
            $table->integer('itemID')->nullable();
            $table->timestamps();
            $table->foreign('googleID')
                ->references('googleID')->on('players')
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
        Schema::dropIfExists('equipment');
    }
}

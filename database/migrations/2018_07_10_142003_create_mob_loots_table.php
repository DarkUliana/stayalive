<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMobLootsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mob_loot', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('key');
            $table->integer('minRandomSize');
            $table->integer('maxRandomSize');
            $table->timestamps();
        });

        Schema::create('mob_loot_items', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('mobLootID');
            $table->integer('itemID');
            $table->integer('minAmount');
            $table->integer('maxAmount');
            $table->double('chance');
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
        Schema::dropIfExists('mob_loot');
        Schema::dropIfExists('mob_loot_items');
    }
}

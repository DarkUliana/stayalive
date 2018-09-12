<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDropItemLootsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drop_item_loots', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('dropItemID');
            $table->integer('itemID');
            $table->integer('minAmount');
            $table->integer('maxAmount');
            $table->float('chance');
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
        Schema::dropIfExists('drop_item_loots');
    }
}

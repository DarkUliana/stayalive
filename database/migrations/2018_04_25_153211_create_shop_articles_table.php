<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_articles', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('shopID')->unique();
            $table->tinyInteger('shopItemCategory');
            $table->boolean('inGold')->default(0);
            $table->float('price');
            $table->integer('sale')->default(0);
            $table->boolean('hot');
            $table->enum('shopItemType', [1, 4, 8]);
            $table->timestamp('dateTime');
            $table->boolean('onSale')->default(0);
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
        Schema::dropIfExists('shop_articles');
    }
}

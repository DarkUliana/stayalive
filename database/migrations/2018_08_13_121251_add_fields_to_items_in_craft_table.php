<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToItemsInCraftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_in_craft', function (Blueprint $table) {
            $table->integer('index')->before('countToCraft');
            $table->integer('techType')->before('countToCraft');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_in_craft', function (Blueprint $table) {

            $table->dropColumn('index');
            $table->dropColumn('techType');
        });
    }
}

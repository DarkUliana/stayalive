<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeItemsInCraftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_in_craft', function (Blueprint $table) {

            $table->renameColumn('index', 'cellIndex');
            $table->integer('floorIndex')->after('techType');
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

            $table->renameColumn('cellIndex', 'index');
            $table->dropColumn('floorIndex');
        });
    }
}

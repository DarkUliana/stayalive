<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPeaceRadiusToMobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mobs', function (Blueprint $table) {

            $table->float('peaceRadius')->after('enemyLevel')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mobs', function (Blueprint $table) {

            $table->dropColumn('peaceRadius');
        });
    }
}

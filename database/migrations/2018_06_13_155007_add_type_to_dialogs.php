<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToDialogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dialogs', function (Blueprint $table) {

            $table->enum('type', ['begin', 'additional'])->after('questID')->default('begin');
        });
        Schema::connection('alive_test')->table('dialogs', function (Blueprint $table) {

            $table->enum('type', ['begin', 'additional'])->after('questID')->default('begin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dialogs', function (Blueprint $table) {
            $table->dropColumn('type');
        });
        Schema::connection('alive_test')->table('dialogs', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}

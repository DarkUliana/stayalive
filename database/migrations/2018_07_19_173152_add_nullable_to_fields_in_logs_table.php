<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNullableToFieldsInLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('logs', function (Blueprint $table) {

            $table->string('googleID')->nullable()->change();
            $table->string('logType')->nullable()->change();
            $table->string('logTime')->nullable()->change();
            $table->text('logCondition')->nullable()->change();
            $table->text('logTrace')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('logs', function (Blueprint $table) {

            $table->string('googleID')->change();
            $table->string('logType')->change();
            $table->string('logTime')->change();
            $table->text('logCondition')->change();
            $table->text('logTrace')->change();
        });
    }
}

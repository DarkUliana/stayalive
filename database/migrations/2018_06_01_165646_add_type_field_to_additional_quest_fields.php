<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeFieldToAdditionalQuestFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('additional_quests_fields', function (Blueprint $table) {
            $table->enum('type', ['integer', 'double', 'string'])->after('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('additional_quests_fields', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}

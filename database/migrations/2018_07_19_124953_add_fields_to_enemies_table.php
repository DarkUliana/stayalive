<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToEnemiesTable extends Migration
{

    protected $fields =
        [
            'attackClose',
            'attackDistance',
            'increaseSpeed',
            'decrease',
            'hill'
        ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enemies', function (Blueprint $table) {

            foreach ($this->fields as $field) {
                $table->boolean($field)->before('created_at')->default(1);
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enemies', function (Blueprint $table) {

            foreach ($this->fields as $field) {
                $table->dropColumn($field);
            }


        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class CreateShipCellTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ship_cell_types', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('index');
            $table->string('name');
            $table->string('color');
            $table->timestamps();
        });

        Artisan::call('db:seed', ['--class' => 'ShipCellTypesTableSeeder']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ship_cell_types');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class CreateDescriptionModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('description_modes', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('index');
            $table->string('name');
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
        Schema::dropIfExists('description_modes');
    }
}

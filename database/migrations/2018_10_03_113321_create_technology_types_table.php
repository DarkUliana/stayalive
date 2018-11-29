<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

class CreateTechnologyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technology_types', function (Blueprint $table) {
            $table->increments('ID');
            $table->bigInteger('index');
            $table->string('name');
            $table->timestamps();
        });

        Artisan::call('db:seed', ['--class' => 'TechnologyTypesTableSeeder']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technology_types');
    }
}

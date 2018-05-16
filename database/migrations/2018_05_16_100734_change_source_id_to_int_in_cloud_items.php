<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeSourceIdToIntInCloudItems extends Migration
{
    protected $table = 'cloud_items';
    protected $column = 'sourceID';
    protected $enum = [
        'goldPurchase',
        'moneyPurchase',
        'boxOpen',
        'craftItem',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->enum as $key => $value) {

            DB::table($this->table)
                ->where($this->column, "$value")
                ->update([$this->column => $key]);
        }

        Schema::table($this->table, function (Blueprint $table) {

            $table->integer($this->column)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->table, function (Blueprint $table) {

            $table->string($this->column)->change();
        });

        foreach ($this->enum as $key => $value) {

            DB::table($this->table)
                ->where($this->column, "$key")
                ->update([$this->column => "$value"]);
        }
    }
}

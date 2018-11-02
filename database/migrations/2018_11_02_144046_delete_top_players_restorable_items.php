<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\PlayerRestorableObjectSlot as Slot;

class DeleteTopPlayersRestorableItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $ids = Slot::select('restorableObjectID')->distinct()->get()->pluck('restorableObjectID');

        foreach ($ids as $id) {

            Slot::where('restorableObjectID', $id)->orderBy('ID')->limit(6)->delete();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

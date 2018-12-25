<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixRestorableBug extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $ids = DB::table('player_restorable_object_slots')
            ->leftJoin('player_restorable_objects', 'player_restorable_object_slots.restorableObjectID', '=', 'player_restorable_objects.ID')
            ->select(DB::raw('count(*) as c, playerID'))
            ->groupBy('restorableObjectID')
            ->groupBy('playerID')
            ->having('c', '=', 4)
            ->distinct()
            ->pluck('playerID');


        foreach ($ids as $id) {

            DB::table('player_restorable_objects')->where('playerID', $id)->update(['isBuilded' => 1]);
            $restorableIds = DB::table('player_restorable_objects')->where('playerID', $id)->pluck('ID');

            foreach ($restorableIds as $restorableId) {

                DB::table('player_restorable_object_slots')->insert(
                    [
                        [
                            'restorableObjectID' => $restorableId,
                            'itemID' => -1,
                            'Index' => 0,
                            'CurrentCount' => 0,
                            'currentDurability' => 0,
                            'available' => 0,
                            'SlotType' => 1023
                        ],
                        [
                            'restorableObjectID' => $restorableId,
                            'itemID' => -1,
                            'Index' => 1,
                            'CurrentCount' => 0,
                            'currentDurability' => 0,
                            'available' => 0,
                            'SlotType' => 1023
                        ],
                        [
                            'restorableObjectID' => $restorableId,
                            'itemID' => -1,
                            'Index' => 2,
                            'CurrentCount' => 0,
                            'currentDurability' => 0,
                            'available' => 0,
                            'SlotType' => 1023
                        ],
                        [
                            'restorableObjectID' => $restorableId,
                            'itemID' => -1,
                            'Index' => 3,
                            'CurrentCount' => 0,
                            'currentDurability' => 0,
                            'available' => 0,
                            'SlotType' => 1023
                        ],
                        [
                            'restorableObjectID' => $restorableId,
                            'itemID' => -1,
                            'Index' => 4,
                            'CurrentCount' => 0,
                            'currentDurability' => 0,
                            'available' => 0,
                            'SlotType' => 1023
                        ],
                        [
                            'restorableObjectID' => $restorableId,
                            'itemID' => -1,
                            'Index' => 5,
                            'CurrentCount' => 0,
                            'currentDurability' => 0,
                            'available' => 0,
                            'SlotType' => 1023
                        ],
                    ]
                );
            }


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

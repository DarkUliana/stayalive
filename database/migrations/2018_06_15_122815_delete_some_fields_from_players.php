<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteSomeFieldsFromPlayers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropColumn('MaximumHP');
            $table->dropColumn('MaximumPower');
            $table->dropColumn('MaximumSatiety');
            $table->dropColumn('FoodDecrement');
            $table->dropColumn('CurrentFoodDecrement');
            $table->dropColumn('MaximumThirst');
            $table->dropColumn('WaterDecrement');
            $table->dropColumn('CurrentWaterDecrement');
            $table->dropColumn('NextLevelExperience');
            $table->dropColumn('AttackPower');
            $table->dropColumn('CurrentAttackPower');
            $table->dropColumn('AttackSpeed');
            $table->dropColumn('CurrentAttackSpeed');
            $table->dropColumn('MovementSpeed');
            $table->dropColumn('CurrentMovementSpeed');
            $table->dropColumn('Armor');
            $table->dropColumn('CurrentArmor');
            $table->dropColumn('AttackDistance');
            $table->dropColumn('CollectDistance');
            $table->dropColumn('CurrentAttackDistance');
            $table->dropColumn('DetectEnemyRadius');
            $table->dropColumn('DetectResourceRadius');
            $table->dropColumn('AttackBonus');
            $table->dropColumn('GatheringBonus');
            $table->dropColumn('CraftTimeImprovementBonus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}




<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('ID');
            $table->string('googleID')->unique();
            $table->string('Name')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->integer('MaximumHP')->nullable();
            $table->integer('CurrentHP')->nullable();
            $table->integer('MaximumPower')->nullable();
            $table->integer('CurrentPower')->nullable();
            $table->integer('MaximumSatiety')->nullable();
            $table->integer('CurrentSatiety')->nullable();
            $table->integer('FoodDecrement')->nullable();
            $table->integer('CurrentFoodDecrement')->nullable();
            $table->integer('MaximumThirst')->nullable();
            $table->integer('CurrentThirst')->nullable();
            $table->integer('WaterDecrement')->nullable();
            $table->integer('CurrentWaterDecrement')->nullable();
            $table->integer('CurrentLevel')->nullable();
            $table->integer('CurrentExperience')->nullable();
            $table->integer('NextLevelExperience')->nullable();
            $table->integer('AttackPower')->nullable();
            $table->integer('CurrentAttackPower')->nullable();
            $table->float('AttackSpeed')->nullable();
            $table->float('CurrentAttackSpeed')->nullable();
            $table->float('MovementSpeed')->nullable();
            $table->float('CurrentMovementSpeed')->nullable();
            $table->boolean('Gender')->nullable();
            $table->integer('Armor')->nullable();
            $table->integer('CurrentArmor')->nullable();
            $table->float('AttackDistance')->nullable();
            $table->float('CollectDistance')->nullable();
            $table->float('CurrentAttackDistance')->nullable();
            $table->float('DetectEnemyRadius')->nullable();
            $table->float('DetectResourceRadius')->nullable();
            $table->boolean('isDie')->nullable();
            $table->boolean('isSpawnInLocation')->nullable();
            $table->integer('goldCoin')->nullable();
            $table->integer('techCoin')->nullable();
            $table->integer('Class')->nullable();
            $table->float('AttackBonus')->nullable();
            $table->float('GatheringBonus')->nullable();
            $table->float('CraftTimeImprovementBonus')->nullable();
            $table->string('fromIsland')->nullable();
            $table->string('toIsland')->nullable();
            $table->boolean('inWalking')->nullable();
            $table->float('timeWalking')->nullable(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('players');
    }
}

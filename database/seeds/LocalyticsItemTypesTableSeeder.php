<?php

use Illuminate\Database\Seeder;

class LocalyticsItemTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('localytics_item_types')->insert([
            [
                'index' => 0,
                'name' => 'res'
            ],
            [
                'index' => 1,
                'name' => 'craft'
            ],
            [
                'index' => 2,
                'name' => 'weapon'
            ],
            [
                'index' => 3,
                'name' => 'armor'
            ],
            [
                'index' => 4,
                'name' => 'food'
            ],
            [
                'index' => 5,
                'name' => 'collectible'
            ],
            [
                'index' => 6,
                'name' => 'chest'
            ],
        ]);
    }
}

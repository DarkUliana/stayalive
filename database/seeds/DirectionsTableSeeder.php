<?php

use Illuminate\Database\Seeder;

class DirectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directions')->insert([

            [
                'index' => 0,
                'name' => 'North'
            ],
            [
                'index' => 1,
                'name' => 'East'
            ],
            [
                'index' => 2,
                'name' => 'South'
            ],
            [
                'index' => 3,
                'name' => 'West'
            ],
        ]);
    }
}

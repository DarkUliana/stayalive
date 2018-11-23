<?php

use Illuminate\Database\Seeder;

class DescriptionModesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('description_modes')->insert([
            [
                'index' => 0,
                'name' => 'HeaderText'
            ],
            [
                'index' => 0,
                'name' => 'LeftText'
            ],
            [
                'index' => 0,
                'name' => 'RightText'
            ],
            [
                'index' => 0,
                'name' => 'WideText'
            ],
            [
                'index' => 0,
                'name' => 'WideImage'
            ],
        ]);
    }
}

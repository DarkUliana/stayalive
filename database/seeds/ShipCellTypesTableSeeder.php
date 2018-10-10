<?php

use Illuminate\Database\Seeder;

class ShipCellTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ship_cell_types')->insert([
            [
                'index' => 0,
                'name' => 'Empty',
                'color' => '#fff'
            ],
            [
                'index' => 1,
                'name' => 'Item',
                'color' => '#d6e8bb'
            ],
            [
                'index' => 2,
                'name' => 'Ghost',
                'color' => '#bbdfe8'
            ],
            [
                'index' => 3,
                'name' => 'Trash',
                'color' => '#c4b19f'
            ],
            [
                'index' => 4,
                'name' => 'Disable',
                'color' => '#dbdbdb'
            ]
        ]);
    }
}

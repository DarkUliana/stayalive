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
                'name' => 'Empty'
            ],
            [
                'index' => 1,
                'name' => 'Item'
            ],
            [
                'index' => 2,
                'name' => 'Ghost'
            ],
            [
                'index' => 3,
                'name' => 'Trash'
            ],
            [
                'index' => 4,
                'name' => 'Disable'
            ]
        ]);
    }
}

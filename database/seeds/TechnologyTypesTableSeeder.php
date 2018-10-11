<?php

use Illuminate\Database\Seeder;

class TechnologyTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('technology_types')->insert([
            [
                'index' => 1 << 0,
                'name' => 'None'
            ],
            [
                'index' => 1 << 1,
                'name' => 'Heart'
            ],
            [
                'index' => 1 << 2,
                'name' => 'Chest'
            ],
            [
                'index' => 1 << 3,
                'name' => 'Trash'
            ],
            [
                'index' => 1 << 4,
                'name' => 'Spring'
            ],
            [
                'index' => 1 << 5,
                'name' => 'FishingNet'
            ],
            [
                'index' => 1 << 6,
                'name' => 'Drier'
            ],
            [
                'index' => 1 << 7,
                'name' => 'WoodworkingMachine'
            ],
            [
                'index' => 1 << 8,
                'name' => 'StoneworkingMachine'
            ],
            [
                'index' => 1 << 9,
                'name' => 'PotteryWheel'
            ],
            [
                'index' => 1 << 10,
                'name' => 'TanningTool'
            ],
            [
                'index' => 1 << 11,
                'name' => 'Loom'
            ],
            [
                'index' => 1 << 12,
                'name' => 'Smelter'
            ],
            [
                'index' => 1 << 13,
                'name' => 'MetalWorkbench'
            ],
            [
                'index' => 1 << 14,
                'name' => 'GunpowderMachine'
            ],
            [
                'index' => 1 << 15,
                'name' => 'AmmoMachine'
            ],
            [
                'index' => 1 << 16,
                'name' => 'NitrumCleaner'
            ]
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class RecipeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('recipe_types')->insert([
            [
                'index' => 0,
                'name' => 'Tools'
            ],
            [
                'index' => 1,
                'name' => 'Weapon'
            ],
            [
                'index' => 2,
                'name' => 'Resources'
            ],
            [
                'index' => 3,
                'name' => 'Clothes'
            ],
            [
                'index' => 4,
                'name' => 'Food'
            ],
            [
                'index' => 5,
                'name' => 'Technology'
            ],
        ]);
    }
}

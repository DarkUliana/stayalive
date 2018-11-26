<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecipeClassTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'ID' => 1,
                'type' => 'CraftRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null'
            ],
            [
                'ID' => 2,
                'type' => 'StackableRecipe, Assembly-CSharp, Version=0.0.0.0, Culture=neutral, PublicKeyToken=null'
            ],
        ];

        DB::table('recipe_class_types')->insert($data);

        foreach ($data as $item) {

            DB::table('recipes')->where('Type', $item['type'])->update(['Type' => $item['ID']]);
        }

    }
}
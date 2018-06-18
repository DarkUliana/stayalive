<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MergingController extends Controller
{
    public $tables = [
        'descriptions',
        'description_localizations',
        'dialogs',
        'dialog_descriptions',
        'items',
        'item_properties',
        'quests',
        'quest_fields',
        'recipes',
        'recipe_technologies',
        'recipe_components',
        'rewards',
        'reward_chest_types',
        'reward_items',
        'shop_articles',
        'shop_article_items',
        'technologies',
        'technology_oppened_items',
        'versions'
    ];

    public $notCopy = [
        'enemies',
        'quest_types',
        'reward_chest_types',
        'speakers',
        'migrations'
    ];

    public function testToProduction()
    {

        foreach ($this->tables as $table) {

            DB::connection('mysql')->table($table)->truncate();
            $data = $this->toArray(DB::connection('alive_test')->table($table)->get());
            DB::connection('mysql')->table($table)->insert($data);

        }
        return back()->with('status', 'Merged!');
    }

    public function productionToTest()
    {
        $tables = (array)DB::connection('mysql')->select('SHOW TABLES');
        $name = 'Tables_in_stay-alive';

        foreach ($tables as $table) {

            if (in_array($table->{$name}, $this->notCopy)) {

               continue;
            }
            DB::connection('alive_test')->table($table->{$name})->truncate();
            $data = $this->toArray(DB::connection('mysql')->table($table->{$name})->get());
            DB::connection('alive_test')->table($table->{$name})->insert($data);

        }
        return back()->with('status', 'Merged!');
    }

    protected function toArray($std)
    {
        $array = [];
        foreach ($std as $item) {

            $array[] = (array)$item;
        }

        return $array;
    }
}

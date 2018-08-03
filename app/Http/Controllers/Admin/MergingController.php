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
//        'reward_chest_types',
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

        set_time_limit(300);
        foreach ($this->tables as $table) {

            DB::connection('stay-alive')->table($table)->truncate();
            $data = $this->toArray(DB::connection('alive_test')->table($table)->get());

            foreach (array_chunk($data, 1000) as $part) {

                DB::connection('stay-alive')->table($table)->insert($part);
            }


        }
        return back()->with('status', 'Merged!');
    }

    public function productionToTest()
    {
        $tables = (array)DB::connection('stay-alive')->select('SHOW TABLES');
        $name = 'Tables_in_stay-alive';

        set_time_limit(300);
        foreach ($tables as $table) {

            if (in_array($table->{$name}, $this->notCopy)) {

               continue;
            }
            DB::connection('alive_test')->table($table->{$name})->truncate();
            $data = $this->toArray(DB::connection('stay-alive')->table($table->{$name})->get());

            foreach (array_chunk($data, 1000) as $part) {

                DB::connection('alive_test')->table($table->{$name})->insert($part);
            }


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

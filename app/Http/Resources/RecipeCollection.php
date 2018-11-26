<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RecipeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $collection = $this->collection->toArray();
//        dd($collection);

        $recipes = [];

        foreach ($collection as $recipe) {
            $temp = [
                'Type' => $recipe['class_type']['type'],
                'Data' => $recipe,
            ];

            unset($temp['Data']['Type']);
            unset($temp['Data']['components']);
            unset($temp['Data']['technologies']);
            unset($temp['Data']['classTypeID']);
            unset($temp['Data']['class_type']);

            if (is_null($temp['Data']['InStack'])) {
                unset($temp['Data']['InStack']);
            }

            $temp['Data']['Components'] = [];
            foreach ($recipe['components'] as $component) {
                $temp['Data']['Components'][] = [
                    'id' => $component['itemID'],
                    'neededCount' => $component['neededCount']
                ];
            }

            $temp['Data']['TechnologiesIDs'] = [];
            foreach ($recipe['technologies'] as $technology) {
                $temp['Data']['TechnologiesIDs'][] = $technology['technologyID'];
            }

            $temp['Data'] = json_encode($temp['Data']);

            $recipes['AllRecepies'][] = $temp;
        }

        return $recipes;
    }
}

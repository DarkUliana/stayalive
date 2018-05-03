<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;


class ShopArticleCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $collection['shopItemSerializeTypes'] = $this->collection->toArray();

        foreach ($collection['shopItemSerializeTypes'] as &$article) {

            $article['dateTime'] = [
                'value' => $article['dateTime']
            ];

            foreach ($article['items'] as $item) {

                $article['shopItem'][] = $item;
            }

            unset($article['items']);
        }
//        var_dump($collection); die();
        return $collection;
    }
}
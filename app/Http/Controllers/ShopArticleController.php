<?php

namespace App\Http\Controllers;

use App\Http\Resources\ShopArticleCollection;
use App\ShopArticle;
use App\ShopArticleItems;
use Illuminate\Http\Request;

class ShopArticleController extends Controller
{
    public function index(Request $request)
    {
        $collection = ShopArticle
            ::where(function ($query) {
                $query->where('shopItemType', '<>',  8)
                    ->orWhere('dateTime', '>', date('Y-m-d H:i:s', time()));
            })
            ->where('onSale', 1)
            ->with('items')->get();
        $articles = new ShopArticleCollection($collection);

        return response($articles, 200);
    }

    public function store(Request $request)
    {
        $articles = $request->input();
        $articles = $this->prepareDataForWrite($articles['shopItemSerializeTypes']);

//        ShopArticleItems::truncate();
//        ShopArticle::truncate();

        $counter = 0;
        foreach ($articles as $article) {

            $articleObject = ShopArticle::create($article['article']);

            foreach ($article['items'] as $item) {

                $itemObject = new ShopArticleItems($item);
                $articleObject->items()->save($itemObject);
            }
            ++$counter;
        }
        return response("Create $counter articles", 200);
    }

    protected function prepareDataForWrite($array)
    {
        $articles = [];
        foreach ($array as $article) {

            $temp['article'] = $article;
            $temp['article']['dateTime'] = $article['dateTime']['value'];
            $temp['items'] = $article['shopItem'];

            unset($temp['article']['shopItem']);

            $articles[] = $temp;
        }
        return $articles;
    }
}

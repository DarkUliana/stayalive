<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Item;
use App\ShopArticle;
use App\ShopArticleItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopArticlesController extends Controller
{
    public $categories =
        [
            'None',
            'Equipment',
            'Resource',
            'Coin'
        ];

    public $validateArray = [

        'shopItemCategory' => 'required|integer',
        'price' => 'required|numeric',
        'sale' => 'required|numeric',
        'hot' => 'required|in:0,1',
        'inGold' => 'required|in:0,1',
        'dateTime' => 'required|date_format:"Y-m-d\TH:i"',
        'items.*.imageName' => 'required|string',
        'items.*.count' => 'required|integer',
        'items.*.inStuck' => 'required|in:0,1'

    ];

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        session(['itemsParams' => $request->getQueryString()]);

        $keyword = $request->get('search');
        $sort = $request->get('sort');
        $type = $request->get('type') ? $request->get('type') : 'asc';
        $perPage = 25;

        $shopArticles = ShopArticle::where([]);
        if (!empty($keyword)) {
            $shopArticles = $shopArticles->where('ShopID', 'LIKE', "%$keyword%");
        }

        if (!empty($sort)) {
            $shopArticles = $shopArticles->orderBy($sort, $type);
        }

        if (empty($keyword) && empty($sort)) {
            $shopArticles = $shopArticles->latest();
        }

        $shopArticles = $shopArticles->paginate($perPage);
        $categories = $this->categories;

        return view('admin.shop-articles.index', compact('shopArticles', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $items = Item::pluck('Name')->toArray();
        return view('admin.shop-articles.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $this->validate($request, array_merge(['shopID' => 'required|unique:shop_articles'], $this->validateArray));


        $requestData = $request->all();
        $article = $requestData;
        unset($article['items']);

        $shopArticle = ShopArticle::create($article);

        if (isset($requestData['items'])) {
            foreach ($requestData['items'] as $item) {

                $articleItem = new ShopArticleItems($item);
                $shopArticle->items()->save($articleItem);
            }
        }


        return redirect('shop-articles' . getQueryParams(request()))->with('flash_message', 'ShopArticles added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $shopArticle = ShopArticle::findOrFail($id);

        return view('admin.shop-articles.show', compact('shopArticle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $shopArticle = ShopArticle::findOrFail($id);
        $shopArticle->dateTime = date('Y-m-d\TH:i', strtotime($shopArticle->dateTime));
        $items = Item::pluck('Name')->toArray();

        foreach ($shopArticle->items as $item)
        if (!in_array($item->imageName, $items)) {

            $items[] = $item->imageName;
        }

        return view('admin.shop-articles.edit', compact('shopArticle', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            $requestData = $request->all();

            if(!isset($requestData['onSale'])) {

                $requestData['onSale'] = 0;
            } else {

                $requestData['onSale'] = 1;
            }

            $shopArticle = ShopArticle::findOrFail($id);
            $shopArticle->update($requestData);

            return response('ok', 200);
        }

        $this->validate($request, $this->validateArray);

        $requestData = $request->all();


        $article = $requestData;
        unset($article['items']);

        $shopArticle = ShopArticle::findOrFail($id);
        $shopArticle->update($article);

        ShopArticleItems::where('articleID', $id)->delete();

        if (isset($requestData['items'])) {
            foreach ($requestData['items'] as $item) {

                $articleItem = new ShopArticleItems($item);
                $shopArticle->items()->save($articleItem);
            }
        }


        return redirect('shop-articles' . getQueryParams(request()))->with('flash_message', 'ShopArticles updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        ShopArticle::destroy($id);
        ShopArticleItems::where('articleID', $id)->delete();

        return redirect('shop-articles' . getQueryParams(request()))->with('flash_message', 'ShopArticles deleted!');
    }

    public function item(Request $request)
    {
        $counter = $request->counter + 1;
        $items = Item::pluck('Name')->toArray();

        return view('admin.shop-articles.item', compact('counter', 'items'));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Language;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        session(['itemsParams' => $request->getQueryString()]);

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $languages = Language::where('language', 'LIKE', "%$keyword%")->latest()->paginate($perPage);
        } else {
            $languages = Language::latest()->paginate($perPage);
        }

        return view('admin.languages.index', compact('languages'));
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
        
        $requestData = $request->all();
        
        Language::create($requestData);

        return redirect('languages' . getQueryParams($request))->with('flash_message', 'Language added!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $language = Language::findOrFail($id);
        $language->update($requestData);

        return redirect('languages' . getQueryParams($request))->with('flash_message', 'Language updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, $id)
    {
        Language::destroy($id);

        return redirect('languages' . getQueryParams($request))->with('flash_message', 'Language deleted!');
    }

    public function languageItem()
    {
        return view('admin.languages.language');
    }
}

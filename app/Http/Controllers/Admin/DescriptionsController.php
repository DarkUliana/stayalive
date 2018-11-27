<?php

namespace App\Http\Controllers\Admin;

use App\DescriptionLocalization;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Description;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class DescriptionsController extends Controller
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
        $sort = $request->get('sort');

        $type = $request->get('type');
        if (empty($type)) {
            $type = 'asc';
        }

        $perPage = 25;

        $descriptions = NULL;

        if (!empty($keyword)) {

            $descriptions = Description::where('key', 'LIKE', "%$keyword%")
            ->OrWhereHas('localizations', function ($q) use ($keyword) {
                $q->where('description_localizations.name', 'LIKE', "%$keyword%")->orWhere('description_localizations.description', 'LIKE', "%$keyword%");
            });
        } else {

            $descriptions = Description::where([]);
        }


        if (!empty($sort) && $sort != 'status') {
            $descriptions = $descriptions->orderBy($sort, $type)->paginate($perPage);

        } elseif ($sort == 'status') {

            if ($type == 'asc') {
                $descriptions = $descriptions->get()->sortBy(function ($description) {
                    return $description->allLanguages;
                });
            } else {
                $descriptions = $descriptions->get()->sortBy(function ($description) {
                    return -$description->allLanguages;
                });
            }

            $page = $request->get('page', 1); // Get the ?page=1 from the url

            $offset = ($page * $perPage) - $perPage;

            $descriptions = new LengthAwarePaginator(
                array_slice($descriptions->toArray(), $offset, $perPage, true), // Only grab the items we need
                count($descriptions), // Total items
                $perPage, // Items per page
                $page, // Current page
                ['path' => $request->url(), 'query' => $request->query()] // We need this so we can keep all old query parameters from the url
            );

        } else {

            $descriptions = $descriptions->latest('updated_at')->paginate($perPage);
        }

        $languagesCount = Language::count();

        return view('admin.descriptions.index', compact('descriptions', 'languagesCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $availableLanguages = [];
        $languages = Language::all();

        return view('admin.descriptions.create', compact('availableLanguages', 'languages'));
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
        $this->validate($request, [
            'key' => 'required|unique:descriptions'
        ]);

        $requestData = $request->all();

        $data = $this->prepareDataForWrite($requestData);

        $description = Description::create($data['description']);

        foreach ($data['localizations'] as $localization) {

            $localizationModel = new DescriptionLocalization($localization);
            $description->localizations()->save($localizationModel);
        }

        return redirect('descriptions' . getQueryParams($request))->with('flash_message', 'Description added!');
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
        $description = Description::findOrFail($id);

        return view('admin.descriptions.show', compact('description'));
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
        $languages = Language::all();
        $description = Description::findOrFail($id);

        $availableLanguages = [];

        foreach ($description->localizations as $localization) {
            $availableLanguages[] = $localization->languageID;
        }

        return view('admin.descriptions.edit', compact('description', 'languages', 'availableLanguages'));
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

        $requestData = $request->all();
        $data = $this->prepareDataForWrite($requestData);

        $description = Description::findOrFail($id);
        $description->update($data['description']);
        $description->touch();

        DescriptionLocalization::where('descriptionID', $id)->delete();

        foreach ($data['localizations'] as $localization) {

            $localizationModel = new DescriptionLocalization($localization);
            $description->localizations()->save($localizationModel);
        }

        return redirect('descriptions' . getQueryParams($request))->with('flash_message', 'Description updated!');
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
        DescriptionLocalization::where('descriptionID', $id)->delete();
        Description::destroy($id);

        return redirect('descriptions')->with('flash_message', 'Description deleted!');
    }

    protected function prepareDataForWrite($data)
    {
        $description['description'] = $data;
        unset($description['description']['localizations']);

        $description['localizations'] = [];

        if (isset($data['localizations'])) {
            $description['localizations'] = $data['localizations'];
        }


        foreach ($description['localizations'] as $key => $localization) {
            if (empty($localization['name']) && empty($localization['description'])) {

                unset($description['localizations'][$key]);
            }
        }

        return $description;
    }

    public function symbols()
    {
        $array = DB::table('description_localizations')->where('languageID', 1)->pluck('description');
//        var_dump($array); die();

        $length = 0;
        $lengthWithoutSpaces = 0;

        foreach ($array as $item) {

            $length += strlen(str_replace("NULL", "", $item));
            $lengthWithoutSpaces += strlen(str_replace("NULL", "", str_replace(" ","", $item)));
        }

        echo $length, ' ', $lengthWithoutSpaces;
    }
}

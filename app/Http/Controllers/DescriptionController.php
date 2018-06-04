<?php

namespace App\Http\Controllers;

use App\DescriptionLocalization;
use App\Language;
use Illuminate\Http\Request;
use App\Description;
use League\Csv\Reader;
use League\Csv\Writer;

class DescriptionController extends Controller
{
    public function show(Request $request, $language)
    {
        $languageModel = Language::where('language', $language)->first();

        if (empty($languageModel)) {
            return response($language . " language not found", 404);
        }
        $localizations = DescriptionLocalization::where('languageID', $languageModel->ID)->with('properties')->get();

        $data['localizationItems'] = [];
        foreach ($localizations as $localization) {

            $data['localizationItems'][] = [
                'key' => $localization->properties->key,
                'name' => $localization->name,
                'description' => $localization->description
            ];
        }

        return response($data, 200);
    }

    public function addEnglishDescriptions(Request $request)
    {
        $items = $request->items;
        $data = $this->prepareForWrite($items);
        foreach ($data as $value) {

            if (empty(Description::where('key', $value['description']['key'])->first())) {

                $description = Description::create($value['description']);
                $localization = new DescriptionLocalization($value['localization']);
                $description->localizations()->save($localization);
            }

        }
        return response('ok', 200);
    }

    public function prepareForWrite($items)
    {
        $data = [];
        $languageID = Language::where('language', 'English')->first()->ID;

        foreach ($items as $item) {
            $temp['description'] = [
                'key' => $item['name']
            ];
            $temp['localization'] = [
                'name' => $item['name'],
                'description' => $item['description'],
                'languageID' => $languageID
            ];

            $data[] = $temp;
        }

        return $data;
    }

    public function export()
    {
        $descriptions = Description::with('localizations')->get();

        $csv = Writer::createFromFileObject(new \SplTempFileObject());

        $csv->insertOne($this->getColumnListing());

        foreach ($descriptions as $description) {
            $csv->insertOne($this->toArrayForExport($description));
        }

        $csv->output('descriptions.csv');

    }

    protected function toArrayForExport($description)
    {
        $array = $description->toArray();

        foreach ($description->localizations->sortBy('languageID') as $localization) {
            $array["{$localization->language->language} name"] = $localization->name;
            $array["{$localization->language->language} description"] = $localization->description;
        }

        unset($array['localizations']);
        unset($array['allLanguages']);

        return $array;
    }

    public function import(Request $request)
    {
//        var_dump($request->input()); die();
        if (!$request->hasFile('csv')) {

            return response('Error', 400);
        }

        $csv = Reader::createFromPath($request->file('csv'), 'r');

        $csv->setOffset(1);
        $csv->each(function ($row) {

            $id = Description::where('key', $row[1])->first()->ID;

            $data = [
                'name' => $row[2],
                'description' => $row[3]
            ];

            DescriptionLocalization::where('descriptionID', $id)
                ->where('languageID', 1)->update($data);

            return true;

        });

        return response('File was uploaded!', 200);

    }

    function getColumnListing()
    {
        $columns = ['ID', 'key'];

        foreach (Language::all() as $language) {
            $columns[] = $language->language . " name";
            $columns[] = $language->language . " description";
        }
        return $columns;
    }
}

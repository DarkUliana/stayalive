<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PurchaseStage;
use Illuminate\Http\Request;

class PurchaseStagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $purchasestages = PurchaseStage::latest()->paginate($perPage);
        } else {
            $purchasestages = PurchaseStage::latest()->paginate($perPage);
        }

        return view('admin.purchase-stages.index', compact('purchasestages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.purchase-stages.create');
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
        
        PurchaseStage::create($requestData);

        return redirect('purchase-stages')->with('flash_message', 'PurchaseStage added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $purchasestage = PurchaseStage::findOrFail($id);

        return view('admin.purchase-stages.show', compact('purchasestage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $purchasestage = PurchaseStage::findOrFail($id);

        return view('admin.purchase-stages.edit', compact('purchasestage'));
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
        
        $purchasestage = PurchaseStage::findOrFail($id);
        $purchasestage->update($requestData);

        return redirect('purchase-stages')->with('flash_message', 'PurchaseStage updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        PurchaseStage::destroy($id);

        return redirect('purchase-stages')->with('flash_message', 'PurchaseStage deleted!');
    }
}

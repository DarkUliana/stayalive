<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LaravelLog;
use Illuminate\Http\Request;

class LaravelLogsController extends Controller
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
            $laravellogs = LaravelLog::where('url', 'LIKE', "%$keyword%")->paginate($perPage);
        } else {
            $laravellogs = LaravelLog::latest()->paginate($perPage);
        }

        return view('admin.laravel-logs.index', compact('laravellogs'));
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
        $laravellog = LaravelLog::findOrFail($id);

        return view('admin.laravel-logs.show', compact('laravellog'));
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
        $laravellog = LaravelLog::findOrFail($id);

        return view('admin.laravel-logs.edit', compact('laravellog'));
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
        LaravelLog::destroy($id);

        return redirect('laravel-logs' . getQueryParams($request))->with('flash_message', 'LaravelLog deleted!');
    }
}

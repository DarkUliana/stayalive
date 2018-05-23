<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Version;
use Illuminate\Http\Request;

class VersionsController extends Controller
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
            $versions = Version::latest()->paginate($perPage);
        } else {
            $versions = Version::latest()->paginate($perPage);
        }

        return view('admin.versions.index', compact('versions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.versions.create');
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
            'name' => 'required|string|unique:versions',
            'version' => 'required|string'
        ]);

        $requestData = $request->all();

        Version::create($requestData);

        return redirect('versions')->with('flash_message', 'Version added!');
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
        $version = Version::findOrFail($id);

        return view('admin.versions.show', compact('version'));
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
        $version = Version::findOrFail($id);

        return view('admin.versions.edit', compact('version'));
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
        $this->validate($request, [
            'name' => 'required|string',
            'version' => 'required|string'
        ]);

        $requestData = $request->all();

        $version = Version::findOrFail($id);
        $version->update($requestData);

        return redirect('versions')->with('flash_message', 'Version updated!');
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
        Version::destroy($id);

        return redirect('versions')->with('flash_message', 'Version deleted!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DiaryStorageNote;
use Illuminate\Http\Request;

class DiaryStorageNotesController extends Controller
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
            $diaryStorageNotes = DiaryStorageNote::latest()->paginate($perPage);
        } else {
            $diaryStorageNotes = DiaryStorageNote::latest()->paginate($perPage);
        }

        return view('admin.diary-storage-notes.index', compact('diaryStorageNotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.diary-storage-notes.create');
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
            'noteID' => 'required|unique:diary_storage_notes'
        ]);

        $requestData = $request->all();
        
        DiaryStorageNote::create($requestData);

        return redirect('diary-storage-notes')->with('flash_message', 'DiaryStorageNote added!');
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
        $diaryStorageNote = DiaryStorageNote::findOrFail($id);

        return view('admin.diary-storage-notes.show', compact('diaryStorageNote'));
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
        $diaryStorageNote = DiaryStorageNote::findOrFail($id);

        return view('admin.diary-storage-notes.edit', compact('diaryStorageNote'));
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
        
        $diaryStorageNote = DiaryStorageNote::findOrFail($id);
        $diaryStorageNote->update($requestData);

        return redirect('diary-storage-notes')->with('flash_message', 'DiaryStorageNote updated!');
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
        DiaryStorageNote::destroy($id);

        return redirect('diary-storage-notes')->with('flash_message', 'DiaryStorageNote deleted!');
    }
}

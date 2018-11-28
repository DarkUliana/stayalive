<?php

namespace App\Http\Controllers\Admin;

use App\DiaryNoteSequence;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DiaryStorageNote;
use App\Quest;
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
        session(['itemsParams' => $request->getQueryString()]);

        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $diaryStorageNotes = DiaryStorageNote::where('noteSubject', 'LIKE', "%$keyword%")->paginate($perPage);
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
        $quests = Quest::orderBy('name')->get();

        return view('admin.diary-storage-notes.create', compact('quests'));
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
        unset($requestData['quests']);
        
        $note = DiaryStorageNote::create($requestData);

        if (isset($request->quests)) {

            foreach ($request->quests as $quest) {

                $data = ['questID' => $quest];
                $noteQuest = new DiaryNoteSequence($data);
                $note->quests()->save($noteQuest);
            }
        }


        return redirect('diary-storage-notes' . getQueryParams($request))->with('flash_message', 'DiaryStorageNote added!');
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
        $noteQuests = $diaryStorageNote->quests()->pluck('questID')->toArray();
        $quests = Quest::orderBy('name')->get();

        return view('admin.diary-storage-notes.edit', compact('diaryStorageNote', 'noteQuests', 'quests'));
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
        unset($requestData['quests']);
        
        $diaryStorageNote = DiaryStorageNote::findOrFail($id);
        $diaryStorageNote->update($requestData);

        DiaryNoteSequence::where('diaryNoteID', $diaryStorageNote->ID)->delete();

        if (isset($request->quests)) {

            foreach ($request->quests as $quest) {

                $data = ['questID' => $quest];
                $noteQuest = new DiaryNoteSequence($data);
                $diaryStorageNote->quests()->save($noteQuest);
            }
        }

        return redirect('diary-storage-notes' . getQueryParams($request))->with('flash_message', 'DiaryStorageNote updated!');
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
        DiaryStorageNote::destroy($id);

        return redirect('diary-storage-notes' . getQueryParams($request))->with('flash_message', 'DiaryStorageNote deleted!');
    }
}

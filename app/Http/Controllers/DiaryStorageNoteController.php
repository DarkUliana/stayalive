<?php

namespace App\Http\Controllers;

use App\DiaryStorageNote;
use Illuminate\Http\Request;

class DiaryStorageNoteController extends Controller
{
    public function get()
    {
        return response(['storageNotes' => DiaryStorageNote::all()]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UnityLog;

class UnityLogsController extends Controller
{
    public function index()
    {
        $perPage = 50;

        $logs = UnityLog::latest()->paginate($perPage);

        return view('admin.unity-logs.index', compact('logs'));
    }

    public function show($id) {

        $log = UnityLog::find($id);

        return view('admin.unity-logs.show', compact('log'));
    }
}
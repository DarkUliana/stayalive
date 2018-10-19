<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\UnityLog;
use Illuminate\Http\Request;

class UnityLogsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 50;
        $logs = null;
        if (isset($request->search)) {

            $logs = UnityLog::where('googleID', 'like', "%$request->search%")->latest();

        } else {

            $logs = UnityLog::latest();
        }

        $logs = $logs->paginate($perPage);

        return view('admin.unity-logs.index', compact('logs'));
    }

    public function show($id) {

        $log = UnityLog::find($id);

        return view('admin.unity-logs.show', compact('log'));
    }
}
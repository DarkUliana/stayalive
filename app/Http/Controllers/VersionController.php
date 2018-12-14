<?php

namespace App\Http\Controllers;

use App\Version;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function __invoke()
    {
        $version = Version::first();
        $now = Carbon::now();
        $time = new Carbon($version->serverTimer);
        $version->serverTimer = $time->diffInSeconds($now);

        return response($version, 200);
    }

}

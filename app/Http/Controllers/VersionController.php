<?php

namespace App\Http\Controllers;

use App\Version;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function __invoke()
    {
        $version = Version::where('name', 'bundle')->first();

        return response($version->version, 200);
    }

}

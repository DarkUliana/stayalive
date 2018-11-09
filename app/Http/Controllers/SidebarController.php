<?php

namespace App\Http\Controllers;

use App\BanList;
use App\Sidebar;
use Illuminate\Http\Request;

class SidebarController extends Controller
{
    public static function get()
    {
        $sidebar['list'] = Sidebar::orderBy('name')->get();
        $sidebar['newPlayersInBan'] = BanList::where('status', 0)->count();

        return $sidebar;
    }
}

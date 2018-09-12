<?php

namespace App\Http\Controllers;

use App\DropItem;
use App\Http\Resources\DropItemCollection;
use Illuminate\Http\Request;

class DropItemController extends Controller
{
    public function get()
    {
        $items = new DropItemCollection(DropItem::all());

        return response($items, 200);
    }
}

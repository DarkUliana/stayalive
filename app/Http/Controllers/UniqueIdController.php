<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UniqueIdController extends Controller
{
    public function __invoke()
    {
        return response(uniqid('id', true), 200);
    }
}

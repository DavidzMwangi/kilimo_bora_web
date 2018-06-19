<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountiesController extends Controller
{
    //

    public function index()
    {
        return view('counties.index');
    }
}

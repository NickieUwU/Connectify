<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function open()
    {
        return view('search');
    }

    public function load($search)
    {
        
    }
}

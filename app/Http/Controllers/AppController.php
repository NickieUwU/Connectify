<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Blade;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function open()
    {
        session_start();
        return view('home');
    }

    public function loadMore(Request $request)
    {
        session_start();
    }
}

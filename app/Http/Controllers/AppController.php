<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function open()
    {
        
        session_start();
        return view('home');
    }
}

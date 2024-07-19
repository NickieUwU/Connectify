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

    public function loadMore(Request $request)
    {
        $post = "<x-Post profileUsername=''></x-Post>";
        return response()->json(["post" => $post]);
    }
}

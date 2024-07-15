<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\SessionServiceProvider;

class SearchController extends Controller
{
    public function open($data)
    {
        session_start();
        $search = "";
        return view('search')->with([
            'username' => $_SESSION['username'],
            'data' => $data,
            'search' => $search
        ]);
    }
    public function setupSearch($data, Request $request)
    {
        session_start();
        $_search = $request->input('search');
        $search = "%$_search%";
        return view('search')->with([
            'username' => $_SESSION['username'],
            'data' => $data,
            'search' => $search,
        ]);
    }

    
}
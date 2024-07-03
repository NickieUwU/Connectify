<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function openCreate()
    {
        return view('create');
    }

    public function makePost()
    {
        session_start();
        $content = $_POST['Content'];
        $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE Username=?', $_SESSION['username']);
        foreach($users as $user)
        {
            $userID = $user['ID'];
        }
        DbHandlerController::query('INSERT INTO Posts (ID, Content) VALUES(?, ?)', $userID, $content);
        return redirect('/home');
    }
}

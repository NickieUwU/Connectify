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

    public function addLike(Request $request)
    {
        $data = new \stdClass();
        $data->ID = $request->ID;
        $data->postID = $request->postID;
        $IsLiked = 'N/A';
        $likes = DbHandlerController::queryAll('SELECT * FROM IsLiked WHERE ID=? AND PostID=?', $data->ID, $data->postID);
        foreach($likes as $like)
        {
            $IsLiked = $like['IsLiked'];
        }
        if($IsLiked == 'N/A')
        {
            DbHandlerController::query('INSERT INTO IsLiked (ID, Post_ID, IsLiked) VALUES (?, ?, ?)', $data->ID, $data->postID, 1);
        }
        return response()->json(['IsLiked' => $IsLiked]);
    }
}

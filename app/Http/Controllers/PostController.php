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
        $IsLiked = 0;
        $likes = DbHandlerController::queryAll('SELECT * FROM IsLiked WHERE ID=? AND Post_ID=?', $data->ID, $data->postID);
        foreach($likes as $like)
        {
            $IsLiked = $like['IsLiked'];
        }
        $posts = DbHandlerController::queryAll('SELECT * FROM Posts WHERE Post_ID=?', $data->postID);
        foreach($posts as $post)
        {
            $likesCount = $post['Likes'];
        }
        if($IsLiked == 0)
        {
            //Adding like
            DbHandlerController::query('INSERT INTO IsLiked (ID, Post_ID, IsLiked) VALUES (?, ?, ?)', $data->ID, $data->postID, 1);
            $likesCount++;
            DbHandlerController::query('UPDATE Posts SET Likes = ? WHERE Post_ID=?', $likesCount, $data->postID);
        }
        else if($IsLiked == 1)
        {
            //Deleting like
            DbHandlerController::query('DELETE FROM IsLiked WHERE ID=? AND Post_ID=?', $data->ID, $data->postID);
            $likesCount--;
            DbHandlerController::query('UPDATE Posts SET Likes = ? WHERE Post_ID=?', $likesCount, $data->postID);
        }
        return response()->json(['IsLiked' => $IsLiked]);
    }
}

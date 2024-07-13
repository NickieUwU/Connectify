<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

use function Pest\Laravel\json;

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
    }

    public function openFullPost($postID)
    {
        session_start();
        $posts = DbHandlerController::queryAll('SELECT * FROM Posts WHERE Post_ID=?', $postID);
        if(!$posts) return redirect('/home');
        foreach($posts as $post)
        {
            $content = $post['Content'];
            $ID = $post['ID'];
            $postDate = $post['PostDate'];
        }
        $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE ID=?', $ID);
        foreach($users as $user)
        {
            $posterName = $user['Name'];
            $posterUsername = $user['Username'];
        }
        $likes = DbHandlerController::queryAll('SELECT * FROM IsLiked WHERE ID=? AND Post_ID=?', $ID, $postID);
        $IsLiked = 0;
        foreach($likes as $like)
        {
            $IsLiked = $like['IsLiked'];
        }
        $style = "";
        if($IsLiked == 0) $style = "post-item bi bi-heart";
        else  $style = "post-item bi bi-heart-fill";
        return view('post')->with([
            'postID' => $postID,
            'ID' => $ID,
            'posterName' => $posterName,
            'posterUsername' => $posterUsername,
            'content' => $content,
            'postDate' => $postDate,
            'style' => $style
        ]);
    }

    public function deleteRepPost(Request $request)
    {
        $data = new \stdClass();
        $data->repPostID = $request->input('repPostID');
        DbHandlerController::query('DELETE FROM Posts WHERE Post_ID=?', $data->repPostID);
        DbHandlerController::query('DELETE FROM Reports WHERE Post_ID=?', $data->repPostID);
        DbHandlerController::query('DELETE FROM Comments WHERE Post_ID=?', $data->repPostID);
    }

    public function deletePostUser($postID)
    {
        DbHandlerController::query('DELETE FROM Posts WHERE Post_ID=?', $postID);
        DbHandlerController::query('DELETE FROM Reports WHERE Post_ID=?', $postID);
        DbHandlerController::query('DELETE FROM Comments WHERE Post_ID=?', $postID);
        return redirect('/home');
    }
}

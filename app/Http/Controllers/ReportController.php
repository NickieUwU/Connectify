<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function openRep($username)
    {
        session_start();
        $logusername = $_SESSION['username'];
        $postID = 0;
        if(!ctype_digit($username))
        {
            return view('report')->with([
                'logusername' => $logusername,
                'username' => $username,
                'postID' => $postID
            ]);
        }
        else
        {
            $posts = DbHandlerController::queryAll('SELECT * FROM Posts WHERE Post_ID=?', $username);
            if(!$posts)
            {
                return redirect('/home');
            }
            foreach($posts as $post)
            {
                $postID = $post['Post_ID'];
                $ID = $post['ID'];
            }
            $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE ID=?', $ID);
            foreach($users as $user)
            {
                $username = $user['Username'];
            }
            return view('report')->with([
                'logusername' => $logusername,
                'username' => $username,
                'postID' => $postID
            ]);
        }  
    }

    public function report(Request $request, $username)
    {
        dd($username);
    }
}

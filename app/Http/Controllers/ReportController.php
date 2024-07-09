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
        $option = $request->ReportOptions;
        if(!ctype_digit($username))
        {
            //user report
            $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE Username=?', $username);
            foreach($users as $user)
            {
                $ID = $user['ID'];
            }
            DbHandlerController::query('INSERT INTO Reports (ID, ReportOption) VALUES (?, ?)', $ID, $option);
        }
        else
        {
            //post report
            $postID = $username;
            $posts = DbHandlerController::queryAll('SELECT * FROM Posts WHERE Post_ID=?', $postID);
            foreach($posts as $post)
            {
                $ID = $post['ID'];
            }
            $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE ID=?', $ID);
            foreach($users as $user)
            {
                $reportedUsername = $user['Username'];
            }
            DbHandlerController::query('INSERT INTO Reports (ID, Post_ID, ReportOption) VALUES (?, ?, ?)', $ID, $postID, $option);
        }

        return redirect('/home');
    }

    public function openReports()
    {
        session_start();
        $username = $_SESSION['username'];
        if($_SESSION['username'] != 'Connectify') return redirect('/home');
        return view('reports')->with([
            'username' => $username
        ]);
    }
}

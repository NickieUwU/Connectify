<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\SessionServiceProvider;

class SearchController extends Controller
{
    public function open($data)
    {
        session_start();
        $isStyle = "nav-link active";
        $notStyle = "nav-link";
        $result = "";
        return view('search')->with([
            'username' => $_SESSION['username'],
            'data' => $data,
            'isStyle' => $isStyle,
            'notStyle' => $notStyle,
            'result' => $result
        ]);
    }

    public function search($data, Request $request)
    {
        session_start();
        $isStyle = "nav-link active";
        $notStyle = "nav-link";
        $input = $request->input('txtSearch');
        $queryInput = "%$input%";
        switch($data)
        {
            case 'users':
                $result = $this->loadUsers($queryInput);
                break;
            case 'posts':
                $result = $this->loadPosts($queryInput);
                break;
        }
        return view('search')->with([
                    'username' => $_SESSION['username'],
                    'data' => $data,
                    'isStyle' => $isStyle,
                    'notStyle' => $notStyle,
                    'result' => $result
        ]);
    }

    public function loadUsers($queryInput)
    {
        $users = DbHandlerController::queryAll("SELECT * FROM `Users` WHERE `Username` LIKE ?", $queryInput);
        foreach($users as $user)
        {
            $name = $user['Name'];
            $username = $user['Username'];
            return "
                <div class='row'>
                    <div class='col-lg-1'>
                        <a href='/profile/$username'>
                            <img src='".asset('images/DefaultPFP.png')."' alt='pfp' class='img-fluid rounded-circle w-100'>
                        </a>
                    </div>
                    <div class='col-lg-11'>
                        <a href='/profile/$username' class='text-decoration-none text-dark fs-2'>
                            <span>$name</span>
                        </a>
                        <span class='ms-1 text-muted'>
                            @$username
                        </span>
                    </div>
                </div>
            ";   
        }
    }

    public function loadPosts($queryInput)
    {
        $posts = DbHandlerController::queryAll('SELECT * FROM Posts WHERE Content LIKE ?', $queryInput);
        $length = 25;
        foreach($posts as $post)
        {
            $postID = $post['Post_ID'];
            $content = $post['Content'];
            if(strlen($content) > $length)
            {
                $content = substr($content, 0, $length) . '...';
            }
            return "
                <div class='row'>
                    <div class='col-lg-12'>
                        <a href='".url('/post/'.$postID)."'>
                           $content Read here 
                        </a>
                    </div>
                </div>
            ";
        }
    }
}
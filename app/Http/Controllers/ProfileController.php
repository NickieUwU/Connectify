<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function open($username)
    {
        $users = DbHandlerController::queryAll("SELECT * FROM Users WHERE Username=?", $username);
        if($users == null)
        {
            return redirect('/home');
        }
        foreach($users as $user)
        {
            $name = $user["Name"];
            $joinDate = $user["JoinDate"];
            $bio = $user["Bio"];
        }
        return view('profile', [
            'username' => $username,
            'name' => $name,
            'bio' => $bio,
            'joinDate' => $joinDate
        ]);
    }
    public function openEdit($username)
    {
        session_start();
        if($username != $_SESSION['username']) return redirect('/editProfile/'.$_SESSION['username']);
        else return view('editProfile');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use App\Http\Controllers\DbHandlerController;
use mysqli;
use Illuminate\Support\Facades\Session;
class SessionController extends Controller
{
    public function open()
    {
        return view('/login');
    }

    public function login()
    {
        session_start();
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        if(empty($username) || empty($password))
        {
            $error = "Please fill in all fields";
            return view('login')->with('error', $error);
        }
        DbHandlerController::connect();
        $users = DbHandlerController::queryAll("SELECT * FROM Users WHERE username=?", $username);
        foreach($users as $user)
        {
            $hashedpassword = $user['Password'];
            if(!password_verify($password, $hashedpassword))
            {
                $error = "Wrong username or password";
                return view('login')->with('error', $error);
            }
            else
            {
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
                return redirect('/home');
            }
        }
    }
}

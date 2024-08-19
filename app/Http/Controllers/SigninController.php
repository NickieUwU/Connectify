<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SigninController extends Controller
{
    public function open()
    {
        return view('signin');
    }
    public function signin()
    {
        session_start();
        DbHandlerController::connect();
        $name = filter_input(INPUT_POST, "name");
        $username = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if(empty($name) || empty($username) || empty($password))
        {
            $error = "Please fill in all fields";
            return view('signin')->with('error', $error);
        }
        $checkusers = DbHandlerController::queryAll('SELECT * FROM Users WHERE Username=?', $username);
        foreach($checkusers as $checkuser)
        {
            if($checkuser["Username"] == $username)
            {
                $error = "User already exists";
                return view('signin')->with('error', $error);
            }
        }
        DbHandlerController::query("INSERT INTO Users (Name, Username, Password) VALUES (?, ?, ?)", $name, $username, $hash);
        $_SESSION["login"] = true;
        $_SESSION['username'] = $username;
        return redirect('/home');
    }
}
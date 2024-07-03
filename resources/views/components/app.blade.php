<?php

use App\Http\Controllers\DbHandlerController;

    session_start();
    if(!isset($_SESSION["login"]) || $_SESSION["login"] == false)
    {
        session_destroy();
        return view("about");
    }
    $isStyle = "btn btn-primary";
    $notStyle = "btn btn-outline-primary";
    $users = DbHandlerController::queryAll("SELECT * FROM Users WHERE Username=?", $_SESSION["username"]);
    foreach($users as $user)
    {
        $username = $user["Username"];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
    <div class="container-fluid">
        <div class="row border h-100">
            <div class="col-lg-2 col-md-1 border d-flex flex-column align-items-center justify-content-top nav-column">
                <a href="/home" class="{{request()->is('home') ? $isStyle : $notStyle}} mt-5">Home</a><br>
                <a href="/search" class="{{request()->is('search') ? $isStyle : $notStyle}} mt-4">Search</a><br>
                <a href="/create" class="{{request()->is('create') ? $isStyle : $notStyle}} mt-4">Create</a><br>
                <a href="/profile/{{$username}}" class="{{request()->is("profile/$username") ? $isStyle : $notStyle}} mt-4">Profile</a>
            </div>
            <div class="col-lg-8 col-md-7 border">
                {{$slot}}
            </div>
        </div>
    </div>
    
</body>
</html>

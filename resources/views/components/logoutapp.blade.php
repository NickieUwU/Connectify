<?php
    $isStyle = "btn btn-primary";
    $notStyle = "btn btn-outline-primary";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>
<body>
    <div class="container">
        <div class="options">
            <a href="/login" class="{{request()->is('login') ? $isStyle : $notStyle}}">Login</a>
            <a href="/signin" class="{{request()->is('signin') ? $isStyle : $notStyle}}">Signin</a>
        </div>
        <div class="login">
            @php
                echo $slot;
            @endphp
        </div>
    </div>
</body>
</html>
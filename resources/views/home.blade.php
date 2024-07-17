<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Home</title>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
       <div class="container-fluid border">
            <div class="scroll" id="Posts">
                
            </div>
        </div> 
    </x-app>
</body>
</html>
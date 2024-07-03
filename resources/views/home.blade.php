<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Home</title>
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
       <div class="container-fluid">
            <x-HomePost loggedusername="{{$_SESSION['username']}}"></x-HomePost>
        </div> 
    </x-app>
    
</body>
</html>
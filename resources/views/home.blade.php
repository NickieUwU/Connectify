<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Home</title>
    <style>
        body 
        {
            overflow: hidden;
        }
        .scroll {
            height: 50%; /* Adjust the height as needed */
            overflow-y: auto;
        }
    </style>
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
       <div class="container-fluid border">
            <div class="scroll">
                <x-HomePost loggedusername="{{$_SESSION['username']}}"></x-HomePost><br>
                <x-HomePost loggedusername="{{$_SESSION['username']}}"></x-HomePost><br>
                <x-HomePost loggedusername="{{$_SESSION['username']}}"></x-HomePost><br>
                <x-HomePost loggedusername="{{$_SESSION['username']}}"></x-HomePost><br>
                <x-HomePost loggedusername="{{$_SESSION['username']}}"></x-HomePost><br>
                <x-HomePost loggedusername="{{$_SESSION['username']}}"></x-HomePost><br>
                <x-HomePost loggedusername="{{$_SESSION['username']}}"></x-HomePost><br>
            </div>
        </div> 
    </x-app>
    
</body>
</html>
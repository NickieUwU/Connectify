@php
    session_start();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Search</title>
</head>
<body>
    <x-app username="{{$_SESSION['username']}}"></x-app>
    <div class="container-fluid">
        
    </div>
</body>
</html>
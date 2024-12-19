@php
    $loggedID = $loggedID[0]['ID'];
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$username}}'s post</title>
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
        <x-Post profileUsername="" name="{{$name}}"
        username="{{$username}}" content="{{$content}}" postID="{{$postID}}"
        postDate="{{$postDate}}" likes="{{$likes}}" loggedID="{{$loggedID}}"></x-Post>
    </x-app>
</body>
</html>
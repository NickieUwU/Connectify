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
        <div class="row d-flex">
            <div class="col-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Comment as {{"@".$_SESSION["username"]}}" aria-label="Comment as {{$_SESSION["username"]}}" aria-describedby="btnMakeComment">
                    <button class="btn btn-outline-success" type="button" id="btnMakeComment"><i class="bi bi-send"></i></button>
                </div>
            </div>
        </div>
        <x-comments postID="{{$postID}}"></x-comments>
    </x-app>
</body>
</html>
@php
    use App\Http\Controllers\DbHandlerController;
    $content = "";
    $users = DbHandlerController::queryAll('SELECT * FROM users ORDER BY RAND() LIMIT 1');
    foreach($users as $user)
    {
        $ID = $user['ID'];
        $name = $user['Name'];
        $username = $user['Username'];
    }
    $posts = DbHandlerController::queryAll('SELECT * FROM Posts WHERE ID=?', $ID);
    foreach($posts as $post)
    {
        $content = $post['Content'];
    }
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/post.css')}}">
</head>
<body>
    <div class="row">
        <div class="col-lg-12 border">
            <img src="{{asset('images/DefaultPFP.png')}}" alt="{{$name.'\'s profile picture'}}" class="rounded-circle img-fluid">
            <span class="fs-2"><a href="/profile/{{$username}}">{{$name}}</a></span>
            <span class="fs-6 text-mute">{{'@'.$username}}</span> 
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 border">
            <textarea readonly class="w-100 h-auto">{{$content}}</textarea>
        </div>
    </div>
</body>
</html>

@php
    use App\Http\Controllers\DbHandlerController;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / </title>
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
        <div class="row">
            <div class="col-lg-3 border">
            </div>
            <div class="col-lg-6 d-flex justify-content-center border">
                <ul class="nav nav-underline">
                    <li class="nav-item">
                        <a href="/profile/{{$username}}/followers" class="nav-link text-black">Followers</a>
                    </li>
                    <li class="nav-item">
                        <a href="/profile/{{$username}}/following" class="nav-link text-black">Following</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 border">

            </div>
        </div>
        @if($link == 'followers')
            @php
                //display followers where following = this username
                $follows = DbHandlerController::queryAll('SELECT * FROM IsFollowed WHERE `Following`=?', $username);
                foreach($follows as $follow)
                {
                    $follower = $follow['Follower'];
                    $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE Username=?', $follower);
                    foreach($users as $user)
                    {
                        $followerName = $user['Name'];
                        echo '
                            <div class="row">
                                <div class="col-lg-1 border">
                                    <a href="/profile/'.$follower.'">
                                        <img src="'.asset("images/DefaultPFP.png").'" alt="pfp" class="pfp img-fluid rounded-circle">
                                    </a>
                                </div>
                            </div>
                        ';
                    }
                }
            @endphp
        @else
        @endif
    </x-app>
</body>
</html>
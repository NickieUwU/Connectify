@php
    use App\Http\Controllers\DbHandlerController;
    $active = 'active';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / {{request()->is("profile/$username/followers") ? "$username's followers" : "people followed by $username"}}</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{asset('css/name.css')}}">
    <link rel="stylesheet" href="{{asset('css/followers.css')}}">
    <link rel="stylesheet" href="{{asset('css/scroll.css')}}">
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
        <div class="row">
            <div class="col-lg-3 col-md-2 col-sm-1 border">
            </div>
            <div class="col-lg-6 d-flex justify-content-center border">
                <ul class="nav nav-underline">
                    <li class="nav-item">
                        <a href="/profile/{{$username}}/followers" class="nav-link text-black {{request()->is("profile/$username/followers") ? $active : ''}}">Followers</a>
                    </li>
                    <li class="nav-item">
                        <a href="/profile/{{$username}}/following" class="nav-link text-black {{request()->is("profile/$username/following") ? $active : ''}}">Following</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 border">

            </div>
        </div>
        <div class="scroll border">
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
                                <div class="row align-items-center mt-2">
                                    <div class="col-lg-3 col-md-2 d-none d-md-block border"></div>
                                    <div class="col-3 col-md-2 d-flex justify-content-end align-items-center border">
                                        <a href="/profile/'.$follower.'">
                                            <img src="'.asset("images/DefaultPFP.png").'" alt="pfp" class="pfp-50 img-fluid rounded-circle">
                                        </a>
                                    </div>
                                    <div class="col-9 col-md-4 d-flex align-items-center border">
                                        <a href="/profile/'.$follower.'" class="text-black name-hover fs-4">
                                            '.$followerName.'
                                        </a>
                                        <span class="text-muted ms-2">
                                            @'.$follower.'
                                        </span>
                                    </div>
                                    <div class="col-lg-3 col-md-2 d-none d-md-block border"></div>
                                </div>
                            ';
                        }
                    }
                @endphp
            @else
                @php
                    $followings = DbHandlerController::queryAll('SELECT * FROM IsFollowed WHERE Follower=?', $username);
                    foreach($followings as $following)
                    {
                        $followingUsername = $following['Following'];
                        $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE Username=?', $followingUsername);
                        foreach($users as $user)
                        {
                            $followingName = $user['Name'];
                            echo '
                                <div class="row align-items-center mt-2">
                                    <div class="col-lg-3 col-md-2 d-none d-md-block border"></div>
                                    <div class="col-3 col-md-2 d-flex justify-content-end align-items-center border">
                                        <a href="/profile/'.$followingUsername.'">
                                            <img src="'.asset("images/DefaultPFP.png").'" alt="pfp" class="pfp-50 img-fluid rounded-circle">
                                        </a>
                                    </div>
                                    <div class="col-9 col-md-4 d-flex align-items-center border">
                                        <a href="/profile/'.$followingUsername.'" class="text-black name-hover fs-4">
                                            '.$followingName.'
                                        </a>
                                        <span class="text-muted ms-2">
                                            @'.$followingUsername.'
                                        </span>
                                    </div>
                                    <div class="col-lg-3 col-md-2 d-none d-md-block border"></div>
                                </div>
                            ';
                        }
                    }
                @endphp
            @endif
        </div>
        <style>
            .pfp-50 {
                width: 50px;
                height: 50px;
            }
        </style>
    </x-app>
</body>
</html>

<?php
    use App\Http\Controllers\DbHandlerController;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/post.css')}}">
</head>
<body>
    <?php 
        if($profileUsername!= $_SESSION['username']) $menu = '<li><a class="dropdown-item" href="/report/{{$postID}}">Report</a></li>';
        elseif($profileUsername  == $_SESSION['username']) $menu = '<li><a class="dropdown-item" href="/deletePost/{{$postID}}">Delete</a>';
        if(request()->is('profile/*'))
        {
            $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE Username=?', $profileUsername);
            foreach($users as $user)
            {
                $ID = $user['ID'];
                $profileName = $user['Name'];
                $posts = DbHandlerController::queryAll('SELECT * FROM Posts WHERE ID=?', $ID);
                $posts = array_reverse($posts);
                foreach($posts as $post)
                {
                    $postID = $post['Post_ID'];
                    $likes = DbHandlerController::queryAll('SELECT * FROM IsLiked WHERE ID=? AND Post_ID=?', $ID, $postID);
                    $IsLiked = 0;
                    foreach($likes as $like)
                    {
                        $IsLiked = $like['IsLiked'];
                    }
                    $style = "";
                    if($IsLiked == 0) $style = "post-item bi bi-heart";
                    else  $style = "post-item bi bi-heart-fill";
                   ?>
                    <div class="row mt-3 border">
                        <div class="col-2 col-md-3 border d-flex align-items-center justify-content-end">
                            <img src="{{ asset("images/DefaultPFP.png") }}" alt="pfp" class="pfp-50 img-fluid rounded-circle">
                        </div>
                        <div class="col-4 col-md-3 border">
                            <div class="fs-5">
                                {{ $profileName }}
                            </div>
                            <div class="text-muted fs-6">
                                {{ '@'.$profileUsername }}
                            </div>
                        </div>
                        <div class="col-3 fs-6 d-flex justify-content-center align-content-center border">
                            {{ $post['PostDate'] }}
                        </div>
                        <div class="col-3 d-flex justify-content-center align-content-center border">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Menu
                                </button>
                                <ul class="dropdown-menu">
                                    @if($profileUsername!= $_SESSION['username'])
                                        <li><a class="dropdown-item" href="/report/{{ $postID }}">Report</a></li>
                                    @elseif($profileUsername  == $_SESSION['username'])
                                        <li><a class="dropdown-item" href="/deletePost/{{ $postID }}">Delete</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            {{ $post['Content'] }}
                        </div>
                        <x-postOpts userID="{{$ID}}" postID="{{$postID}}" heartStyle="{{$style}}"></x-postOpts>
                    </div>
                    <?php
                }
            }
        }
        ?>
</body>
</html>
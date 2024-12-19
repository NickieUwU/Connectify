<?php
    use App\Http\Controllers\DbHandlerController;
    use Illuminate\Support\Facades\Route;
?>  
<link rel="stylesheet" href="{{asset('css/post.css')}}">
<link rel="stylesheet" href="{{asset('css/name.css')}}">
<body>
    <?php 
        if($profileUsername != $_SESSION['username']) $menu = '<li><a class="dropdown-item" href="/report/{{$postID}}">Report</a></li>';
        elseif($profileUsername  == $_SESSION['username']) $menu = '<li><a class="dropdown-item" href="/deletePost/{{$postID}}">Delete</a>';
        if(Route::currentRouteName() === "profile.*")
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
                                {{$profileName}}
                            </div>
                            <div class="text-muted fs-6">
                                {{ '@'.$profileUsername }}
                            </div>
                        </div>
                        <div class="col-3 fs-6 d-flex justify-content-center align-content-center border">
                            {{ $post['PostDate'] }}
                        </div>
                        <div class="col-3 d-flex justify-content-center align-items-center border">
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
                        <div class="col-12 text-center border">
                            {{ $post['Content'] }}
                        </div>
                        <x-postOpts userID="{{$ID}}" postID="{{$postID}}" heartStyle="{{$style}}"></x-postOpts>
                    </div>
                    <?php
                }
            }
        }
        elseif(Route::currentRouteName() === "post.*")
        {
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
                <div class="row mt-2">
                    <div class="col-2 d-flex align-items-center justify-content-end">
                        <img src="{{asset("images/DefaultPFP.png")}}" alt="pfp" class="pfp-50 img-fluid rounded-circle">
                    </div>
                    <div class="col-3">
                        <div class="fs-5">
                            <a href="profile/{{$username}}" class="name-hover">
                                {{$name}}
                            </a>
                        </div>
                        <div class="text-muted fs-6">
                            {{"@$username"}}
                        </div>
                    </div>
                    <div class="col-3 d-flex align-items-center justify-content-center border">
                        {{$postDate}}
                    </div>
                    <div class="col-4 d-flex justify-content-center align-items-center border">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                            </button>
                            <ul class="dropdown-menu">
                                @if($username!= $_SESSION['username'])
                                    <li><a class="dropdown-item" href="/report/{{ $postID }}">Report</a></li>
                                @elseif($username  == $_SESSION['username'])
                                    <li><a class="dropdown-item" href="/deletePost/{{ $postID }}">Delete</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center border">
                        {{$content}}
                    </div>
                </div>
                @if($ID !== null)
                <x-postOpts userID="{{$loggedID}}" postID="{{$postID}}" heartStyle="{{$style}}"></x-postOpts>
                @endif
            <?php
        }
        elseif(Route::currentRouteName() === "home")
        {
            $posts = DbHandlerController::queryAll('SELECT * FROM Posts ORDER BY RAND() LIMIT 1');
            foreach($posts as $post)
            {
                $postID = $post['Post_ID'];
                $ID = $post['ID'];
                $content = $post['Content'];
                $postDate = $post['PostDate'];
                $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE ID=?', $ID);
                foreach($users as $user)
                {
                    $name = $user['Name'];
                    $username = $user['Username'];
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
                        <div class="row mt-2">
                            <div class="col-2 d-flex align-items-center justify-content-end">
                                <img src="{{asset("images/DefaultPFP.png")}}" alt="pfp" class="pfp-50 img-fluid rounded-circle">
                            </div>
                            <div class="col-3">
                                <div class="fs-5">
                                    <a href="profile/{{$username}}" class="name-hover">
                                        {{$name}}
                                    </a>
                                </div>
                                <div class="text-muted fs-6">
                                    {{"@$username"}}
                                </div>
                            </div>
                            <div class="col-3 d-flex align-items-center justify-content-center border">
                                {{$postDate}}
                            </div>
                            <div class="col-4 d-flex justify-content-center align-items-center border">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Menu
                                    </button>
                                    <ul class="dropdown-menu">
                                        @if($username!= $_SESSION['username'])
                                            <li><a class="dropdown-item" href="/report/{{ $postID }}">Report</a></li>
                                        @elseif($username  == $_SESSION['username'])
                                            <li><a class="dropdown-item" href="/deletePost/{{ $postID }}">Delete</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-center border">
                                {{$content}}
                            </div>
                        </div>
                        <x-postOpts userID="{{$ID}}" postID="{{$postID}}" heartStyle="{{$style}}"></x-postOpts>
                    <?php
                }
            }
        }
        ?>
<script type="text/javascript">
    $(document).ready(() => {
        $("#postMenuForm").on('submit', (e) => {
            e.preventDefault();
            $.ajax({
                url: "/ajaxDeletePostUser",
                type: "POST",
                data: $("#postMenuForm").serialize(),
                success: (resp) => {
                    location.reload();
                },
                error: (xhr, status, error) => {
                        console.error(xhr.responseText);
                }
            });
        });
    });
</script>
</body>
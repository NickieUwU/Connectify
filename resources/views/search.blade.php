@php
    use App\Http\Controllers\DbHandlerController;
    $active = 'active';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Search</title>
    <link rel="stylesheet" href="{{asset('css/scroll.css')}}">
    <link rel="stylesheet" href="{{asset('css/pfp.css')}}">
    <link rel="stylesheet" href="{{asset('css/scroll.css')}}">
    <link rel="stylesheet" href="{{asset('css/name.css')}}">
</head>
<body>
    <x-app username="{{$username}}">
            <div class="row mt-3">
                <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <form action="{{$data}}" method="post">
                        <div class="input-group">
                            <input type="search" placeholder="Search" name="search" class="form-control" autocomplete="off">
                            <button type="submit" class="btn btn-outline-secondary">
                                <span class="bi bi-search">Search</span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
            </div>
            <div class="row mt-2">
            <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
            <div class="col-lg-6 col-md-8 col-sm-12 d-flex justify-content-center">
                <ul class="nav nav-underline">
                    <li class="nav-item">
                        <a class="nav-link text-black {{request()->is('search/users')? $active : ''}}" href="/search/users">
                            users
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-black {{request()->is('search/posts')? $active : ''}}" href="/search/posts">
                            posts
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
            </div>
            <div class="scroll-search">
                @php
                    if(empty($search))
                    {
                        echo '';
                    }
                    else
                    {
                        if($data=='users')
                        {
                            $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE Username LIKE ?', $search);
                            foreach($users as $user)
                            {
                                $srchName = $user['Name'];
                                $srchUsername = $user['Username'];
                                echo '
                                        <div class="row align-items-center mt-2">
                                        <div class="col-lg-3 col-md-2 d-none d-md-block "></div>
                                        <div class="col-3 col-md-2 d-flex justify-content-end align-items-center border-bottom">
                                            <a href="/profile/'.$srchUsername.'">
                                                <img src="'.asset("images/DefaultPFP.png").'" alt="pfp" class="pfp-50 img-fluid rounded-circle">
                                            </a>
                                        </div>
                                        <div class="col-9 col-md-4 d-flex align-items-center border-bottom">
                                            <a href="/profile/'.$srchUsername.'" class="text-black name-hover fs-4">
                                                '.$srchName.'
                                            </a>
                                            <span class="text-muted ms-2">
                                                @'.$srchUsername.'
                                            </span>
                                        </div>
                                        <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
                                    </div>
                                ';
                            }
                        }
                        else
                        {
                            $posts = DbHandlerController::queryAll('SELECT * FROM Posts WHERE Content LIKE ?', $search);
                            foreach($posts as $post)
                            {
                                $postID = $post['Post_ID'];
                                $content = $post['Content'];
                                $ID = $post['ID'];
                                if(strlen($content) > 25)
                                {
                                    $content = substr($content, 0, 25);
                                    $content .= '...';
                                }
                                $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE ID=?', $ID);
                                foreach($users as $user)
                                {
                                    $postName = $user['Name'];
                                    $postUsername = $user['Username'];
                                    $content .= ' by @'.$postUsername;
                                    echo '
                                        <div class="row align-items-center mt-2">
                                        <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
                                        <div class="col-lg-6 col-md-8 col-sm-12 d-flex justify-content-center border-bottom">
                                            <a href="/post/'.$postID.'" class="text-black name-hover fs-4">'.$content.'
                                        </div>
                                        <div class="col-lg-3 col-md-2 d-none d-md-block "></div>
                                        </div>
                                    ';
                                }
                            }
                        }
                    }
                @endphp
            </div>
    </x-app>
</body>
</html>
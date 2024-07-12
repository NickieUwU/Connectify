<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Search</title>
</head>
<body>
    <x-app username="{{$username}}">
            <div class="row">
                <div class="col-lg-12 text-center mt-3">
                    <h1>Search</h1>
                </div>
            </div>
            <form action="" method="post">
            <div class="row mt-5">
                <div class="col-lg-7 d-flex justify-content-end align-content-center">
                    <input type="text" name="txtSearch" placeholder="search" class="w-50" autocomplete="off">
                </div>
                <div class="col-lg-auto">
                    <button type="submit">
                        <span class="bi bi-search">Search</span>
                    </button>
                </div>
            </form>
            <div class="row">
                <div class="col-lg-12 mt-2 d-flex justify-content-center align-content-center">
                    <ul class="nav nav-underline">
                        <li class="nav-item me-2">
                            <a class="{{request()->is('search/posts') ? $isStyle : $notStyle}} text-black" href="{{url('search/posts')}}">Posts</a>
                        </li>
                        <li class="nav-item">
                            <a class="{{request()->is('search/users') ? $isStyle : $notStyle}} text-black" href="{{url('search/users')}}">Users</a>
                        </li>
                    </ul>
                </div>
            </div>
            {!!$result!!}
    </x-app>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / {{"$name (@$username)"}}</title>
    <link rel="stylesheet" href="{{asset("css/pfp.css")}}">
    <link rel="stylesheet" href="{{asset("css/scroll.css")}}">
    <link rel="stylesheet" href="{{asset("css/name.css")}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <x-app username="{{$username}}">
        <div class="row mt-3 d-flex">
            <div class="col-2 col-md-3 border d-flex align-items-center justify-content-end">
                <img src="{{asset("images/DefaultPFP.png")}}" alt="pfp" class="pfp-50 img-fluid rounded-circle">
            </div>
            <div class="col-4 col-md-3 border">
                <div class="fs-5">
                    {{$name}}
                </div>
                <div class="text-muted fs-6">
                    {{"@$username"}}
                </div>
            </div>
            @if($_SESSION['username'] != $username)
                <div class="col-3 col-md-3 d-flex align-items-center border">
                    {!!$action!!}
                </div>
                <div class="col-3 col-md-3 d-flex align-items-center border">
                    @if($username != $_SESSION['username'])
                        <div class="ms-1 dropdown">
                            <button class="bg bg-transparent border border-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="/report/{{$username}}">Report</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            @else
                <div class="col-5 col-md-6 d-flex align-items-center justify-content-center border">
                    {!!$action!!}
                </div>
            @endif
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-4 border">
                <a href="/profile/{{$username}}/followers" class="name-hover text-black d-flex justify-content-end">
                    {{"$followers followers"}}
                </a>
            </div>
            <div class="col-4 border">
                <a href="/profile/{{$username}}/following" class="name-hover text-black">
                    {{"$following following"}}
                </a>
            </div>
            <div class="col-4 border">
                <span class="bi bi-calendar3 fs-5"> Joined {{$joinDate}}</span>
            </div>
        </div>
        <div class="row d-flex align-items-center">
            <div class="col-12 text-center border">
                {{$bio}}
            </div>
        </div>
        <x-Post profileUsername="{{$username}}"></x-Post>
    </x-app>
    
</body>
</html>

<!-- 
<div class="row border">
    <div class="col-lg-4 border">
        <div class="pfp text-center mb-3 mt-3">
            <img src="{{asset('images/DefaultPFP.png')}}" alt="Profile Picture" class="rounded-circle img-fluid">
        </div>
    </div>
    <div class="col-lg-3 border">
        <div class="fullname border">
            <div class="name mb-3">
                {{$name}}
            </div>
            <div class="username text-muted text-center">
                {{'@'.$username}}
            </div>
        </div>
            
    </div>
    <div class="col-lg-3 d-flex flex-column align-items-center justify-content-center border">
        <span class="bi bi-calendar3 fs-5"> Joined {{$joinDate}}</span>
        <br><br><br>
        <div class="inline-links">
            <a href="/profile/{{$username}}/followers">{{$followers." followers"}}</a>
            <a href="/profile/{{$username}}/following">{{$following." following"}}</a>
        </div>
    </div>
    <div class="col-lg-2 text-center border mt-2">
        @if($username != $_SESSION['username'])
            <div class="dropdown">
                <button class="bg bg-transparent border border-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Menu
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="/report/{{$username}}">Report</a>
                    </li>
                </ul>
            </div>
        @endif
        <br>
        {!! $action !!}
    </div>
</div>
<div class="row">
    <div class="col-lg-12 text-center h-auto border">
        {{$bio}}
    </div>
</div>
-->
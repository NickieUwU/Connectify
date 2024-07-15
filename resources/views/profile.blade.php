<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / {{$username}}</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/ProfileMenu.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
    <script src="{{asset('js/Profile.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/pfp.css')}}">
    <link rel="stylesheet" href="{{asset('css/name.css')}}">
    <link rel="stylesheet" href="{{asset('css/scroll.css')}}">
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
        <div class="row mt-5">
            <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
            <div class="col-3 col-md-2 d-flex justify-content-end align-items-center border">
                <img src="{{asset("images/DefaultPFP.png")}}" alt="pfp" class="pfp-50 img-fluid rounded-circle">
            </div>
            <div class="col-9 col-md-4 d-flex align-items-center border">
                <div>
                    <div class="fs-2">
                        {{$name}}
                    </div>
                    <div class="text-muted fs-6">
                        {{'@'.$username}}
                    </div>
                </div>
                @if($username != $_SESSION['username'])
                <div class="ms-auto">
                    <div class="dropdown">
                        <button class="bg-transparent border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="/report/{{$username}}">Report</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
            <div class="col-lg-3 col-md-2 col-sm text-center border">
                <div>
                    <a href="/profile/{{$username}}/followers" class="name-hover text-black me-2">
                        {{$followers." followers"}}
                    </a>
                    <a href="/profile/{{$username}}/following" class="name-hover text-black">
                        {{$following." following"}}
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-2 col-sm text-center border">
                {{$joinDate}}{!! $action !!}
            </div>
            <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
        </div>
    </x-app>
<script type="text/javascript">
    $(document).ready(() => {
        $('#addFollow').on('submit', (event) => {
            event.preventDefault();
            $.ajax({
                url: '/ajaxfollow',
                data: jQuery('#addFollow').serialize(),
                type: 'POST',
                success: (res) => {
                },
                error: (xhr, status, error) => {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
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
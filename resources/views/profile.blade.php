<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / {{$username}}</title>
    <script src="{{asset('js/ProfileMenu.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/profile.css')}}">
</head>
<body>
    <x-app>
    <div class="container-fluid">
            <div class="row border">
                <div class="col-lg-4 border">
                    <div class="pfp text-center mb-3 mt-3">
                        <img src="{{asset('images/DefaultPFP.png')}}" alt="Profile Picture" class="rounded-circle img-fluid">
                    </div>
                </div>
                <div class="col-lg-4 border">
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
                <span class="bi bi-calendar3"> Joined {{$joinDate}}</span>
                </div>
                <div class="col-lg-1 text-center border">
                    <a href="/editProfile/{{$username}}" class="btnedit btn btn-secondary fs-6">Edit Profile</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center h-auto border">
                    {{$bio}}
                </div>
            </div>
        </div>
    </x-app>
</body>
</html>
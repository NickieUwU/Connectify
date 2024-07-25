<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Edit Profile</title>
    <link rel="stylesheet" href="{{asset('css/editProfile.css')}}">
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center mt-4">
                    <h1>
                        Edit Profile
                    </h1>
                </div>
            </div>
            <div class="row">
                <form action="{{url('editProfile/'.$_SESSION['username'])}}" method="post">
                    <div class="col-lg-12 text-center mt-5">
                        <input type="text" class="text-center" name="Name" placeholder="{{$name}}" max="30">
                    </div>
                    <div class="col-lg-12 text-center mt-2">
                        <input type="text" class="text-center" name="Username" placeholder="{{$username}}" max="15">
                    </div>
                    <div class="col-lg-12 text-center mt-2 border">
                        <textarea class="bio w-100" class="w-100" name="Bio" placeholder="{{$bio}}" maxlength="80"></textarea>
                    </div>
                    <div class="col-12 text-center">
                        <a href="/password-reset">Forgot password</a>
                    </div>
                    <div class="col-lg-12 text-center mt-2">
                        <input type="submit" class="btn btn-secondary" value="Save">
                    </div>
                    <div class="col-lg-12 text-center">
                        {{$result}}
                    </div>
                </form>
            </div>
        </div>
    </x-app>
</body>
</html>
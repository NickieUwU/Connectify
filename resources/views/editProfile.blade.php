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
                        <input type="text" class="text-center" placeholder="{{$name}}">
                    </div>
                    <div class="col-lg-12 text-center mt-2">
                        <input type="text" class="text-center" placeholder="{{$username}}">
                    </div>
                    <div class="col-lg-12 text-center mt-2 border">
                        <textarea class="bio" class="w-100" placeholder="{{$bio}}"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </x-app>
</body>
</html>
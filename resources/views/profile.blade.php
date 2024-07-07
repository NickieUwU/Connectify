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
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
    <div class="container-fluid">
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
                <span class="bi bi-calendar3"> Joined {{$joinDate}}</span>
                </div>
                <div class="col-lg-2 text-center border mt-2">
                    @if($username != $_SESSION['username'])
                        <span class="bi bi-three-dots mt-3"></span>
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
                        console.log(res);
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
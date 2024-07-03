@php
    session_start();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Create</title>
    <link rel="stylesheet" href="{{asset('css/create.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('js/Create.js')}}"></script>
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
        <form action="/create" method="POST">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 text-center fs-1 mt-3">
                        What is happening?
                    </div>
                </div>
                <div class="row divContent mt-5" style="height: 15vh;">
                    <div class="col-lg-12" align="center">
                        <textarea class="content" name="Content" id="IDcontent" maxlength="500" oninput="updateCounter()"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <span id="chars">0/500</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <button type="submit" name="btnSubmit" class="btn btn-secondary">Post</button>
                    </div>
                </div>
            </div>
        </form>
    </x-app>
</body>
</html>
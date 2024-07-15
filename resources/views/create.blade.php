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
<style>
    body
    {
        overflow: hidden;
    }
</style>
<body>
    <x-app username="{{$_SESSION['username']}}">
        <form action="/create" method="post">
            <div class="row mt-3">
                <div class="col-12 d-flex justify-content-center border-bottom">
                    <h1>What's happening?</h1>
                </div>
            </div>
            <div class="row mt-2" style="height: 23vh;">
                <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
                <div class="col-lg-6 col-md-8 col-sm-12">
                    <textarea class="content" name="Content" id="IDcontent" maxlength="500" oninput="updateCounter()"></textarea>
                </div>
                <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
                <div class="col-lg-6 col-md-8 col-sm-12 d-flex justify-content-center">
                    <span id="chars">0/500</span>
                </div>
                <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
                <div class="col-lg-6 col-md-8 col-sm-12 d-flex justify-content-center">
                    <button type="submit" name="btnSubmit" class="btn btn-outline-secondary">Post</button>
                </div>
                <div class="col-lg-3 col-md-2 d-none d-md-block"></div>
            </div>
        </form>
    </x-app>
</body>
</html>
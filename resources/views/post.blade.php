<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / {{$posterUsername}}'s post </title>
    <link rel="stylesheet" href="{{asset('css/fullPost.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/Post.js')}}"></script>
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 text-center fs-1">
                    {{$posterUsername}}'s post
                </div>
            </div>
            <div class="row mt-5 border">
                <div class="col-lg-1 border">
                    <a href="/profile/{{$posterUsername}}">
                        <img src="{{asset('images/DefaultPFP.png')}}" alt="pfp" class="pfp img-fluid rounded-circle">
                    </a>
                </div>
                <div class="col-lg-5 border">
                    <span>
                        <a href="/profile/{{$posterUsername}}">{{$posterName}}</a>
                    </span>
                    <br>
                    <span class="text-muted">
                        {{'@'.$posterUsername}}
                    </span>
                </div>
                <div class="col-lg-6 d-flex align-items-center justify-content-center border">
                    <span>
                        {{$postDate}}
                    </span>
                </div>
            </div>
            <div class="row" style="height: 15vh;">
                <div class="col-lg-12 border">
                    <textarea class="w-100 h-100" readonly>{{$content}}</textarea>
                </div>
            </div>
            <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-2 text-center border">
            <form action="{{url('ajaxupload')}}" method="post" id="addLikeForm">
                <input type="hidden" name="ID" value="{{$ID}}">
                <input type="hidden" name="postID" value="{{$postID}}">
                <button type="submit" id="btnHeart" class="{{$style}}" id="heart"></button>
            </form>  
        </div>
        <div class="col-lg-4 col-md-3 col-sm-2 text-center border">
            <a href="/post/{{$postID}}"><span class="bi bi-chat-dots"></span></a>
        </div>
        <div class="col-lg-4 col-md-3 col-sm-2 text-center border">
            <span class="bi bi-share"></span>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(() => {
            $('#addLikeForm').on('submit', (event) => {
                event.preventDefault();
                jQuery.ajax({
                    url: "{{url('ajaxupload')}}",
                    data: jQuery('#addLikeForm').serialize(),
                    type: 'POST',
                    success: (result) => {
                        
                    },
                    error: (xhr, status, error) => {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
        </div>
    </x-app>
</body>
</html>
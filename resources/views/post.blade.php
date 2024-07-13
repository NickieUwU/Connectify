<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / {{$posterUsername}}'s post </title>
    <link rel="stylesheet" href="{{asset('css/fullPost.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/Post.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/comments.css')}}">
    <script src="{{asset('js/Comments.js')}}"></script>
    <script src="{{asset('js/postMenu.js')}}"></script>
</head>
<body>
    <x-app username="{{$_SESSION['username']}}">
        <div class="scroll">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 text-center fs-1">
                        {{$posterUsername}}'s post
                    </div>
                </div>
                <div class="row mt-5">
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
                    <div class='col-lg-6 border d-flex align-items-center justify-content-center position-relative'>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                            </button>
                            <ul class="dropdown-menu">
                                @if($username != $_SESSION['username'])
                                    <li><a class="dropdown-item" href="/report/{{$postID}}">Report</a></li>
                                @elseif($username == $_SESSION['username'])
                                    <li><a class="dropdown-item" href="#">Delete</a>
                                @endif
                                
                            </ul>
                        </div>
                        <span>{{$postDate}}</span>
                    </div>
                </div>
                <div class="row" style="height: 15vh;">
                    <div class="col-lg-12 border">
                        <textarea class="w-100 h-100" readonly>{{$content}}</textarea>
                    </div>
                </div>
                <x-postOpts userID="{{$ID}}" postID="{{$postID}}" heartStyle="{{$style}}"></x-postOpts>
                <form action="/ajaxAddComment" id="addComment" method="post">
                    <div class="row" style="height: auto;">
                        <div class="col-lg-12">
                            <textarea placeholder="Add a comment" name="commentContent" class="w-100 h-100" maxlength="1000"></textarea>
                        </div>
                    </div>
                    <div class="row text-center mt-3">
                        <div class="col-lg-12">
                            <input type="hidden" name="ID" value="{{$ID}}">
                            <input type="hidden" name="postID" value="{{$postID}}">
                            <button type="submit" class="btn btn-secondary">Add</button>
                        </div>
                    </div>
                </form>
                <x-comments postID="{{$postID}}"></x-comments>
            </div>
            <div class="menuDiv position-absolute top-0 end-0">
                <x-postMenu posterUsername="{{$posterUsername}}" postID="{{$postID}}"></x-postMenu>
            </div>
            
        </div>
    </x-app>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#addComment').on('submit', (event) => {
                event.preventDefault();
                $.ajax({
                    url: '/ajaxAddComment',
                    type: 'POST',
                    data: $('#addComment').serialize(),
                    success: (resp) => {
                        
                    },
                    error: (xhr, status, error) => {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
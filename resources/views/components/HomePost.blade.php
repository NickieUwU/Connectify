@php
    use App\Http\Controllers\DbHandlerController;
    DbHandlerController::connect();
    $content = "";
    $likes = 'N/A';
    $postID = 0;
    $isLiked = 0;
    $users = DbHandlerController::queryAll('SELECT * FROM users ORDER BY RAND() LIMIT 1');
    foreach($users as $user)
    {
        $ID = $user['ID'];
        $name = $user['Name'];
        $username = $user['Username'];
    }
    $posts = DbHandlerController::queryAll('SELECT * FROM Posts WHERE ID=?', $ID);
    foreach($posts as $post)
    {
        $postID = $post['Post_ID'];
        $content = $post['Content'];
        $likes = $post['Likes'];
    }
    $likeds = DbHandlerController::queryAll('SELECT * From IsLiked WHERE ID=? AND Post_ID=?', $ID, $postID);
    foreach($likeds as $liked)
    {
        $isLiked = $liked['IsLiked'];
    }

    if($isLiked == 1) $heartStyle = 'bi bi-heart-fill';
    else $heartStyle = 'bi bi-heart';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/post.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/HomePost.js')}}"></script>
</head>
<body>
    <div class="row">
        <div class="col-lg-12 border">
            <img src="{{asset('images/DefaultPFP.png')}}" alt="{{$name.'\'s profile picture'}}" class="rounded-circle img-fluid">
            <span class="fs-2"><a href="/profile/{{$username}}">{{$name}}</a></span>
            <span class="fs-6 text-mute">{{'@'.$username}}</span> 
        </div>
    </div>
    <div class="row" style="height: 15vh;">
        <div class="col-lg-12 border">
            <textarea readonly class="w-100 h-100">{{$content}}</textarea>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-2 text-center border">
            <form action="{{url('ajaxupload')}}" method="post" id="addLikeForm">
                <input type="hidden" name="ID" value="{{$ID}}">
                <input type="hidden" name="postID" value="{{$postID}}">
                <button type="submit" class="{{$heartStyle}}" id="heart"> {{$likes}}</button>
            </form>
            
        </div>
        <div class="col-lg-4 col-md-3 col-sm-2 text-center border">
            <span class="bi bi-chat-dots"></span>
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
                        {{$likes++}}
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
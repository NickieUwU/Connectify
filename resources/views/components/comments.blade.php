@php
    use App\Http\Controllers\DbHandlerController;
    $comments = DbHandlerController::queryAll('SELECT * FROM comments WHERE Post_ID=?', $postID);
    if($comments==null) echo"";
    foreach($comments as $comment)
    {
        $commentContent = $comment['CommentContent'];
        $commentDate = $comment['CommentDate'];
        $ID = $comment['ID'];
        $users = DbHandlerController::queryAll('SELECT * FROM users WHERE ID=?', $ID);
        foreach($users as $user)
        {
            $name = $user['Name'];
            $username = $user['Username'];
            echo "
                <div class='row mt-5'>
                    <div class='col-lg-1'>
                        <a href='/profile/$username'>
                            <img src='".asset('images/DefaultPFP.png')."' alt='pfp' class='pfpComment img-fluid rounded-circle'>
                        </a>
                    </div>
                    <div class='col-lg-6'>
                        <span>
                            <a href='/profile/$username'>$name</a>
                        </span><br>
                        <span class='text-muted'>@$username</span>
                    </div>
                    <div class='col-lg-5 border d-flex align-items-center justify-content-center position-relative'>
                        <span class='position-absolute top-0 end-0'>
                            <i class='bi bi-three-dots-vertical'></i>
                        </span>
                        <span>$commentDate</span>
                    </div>
                </div>
                <div class='row' style='height: 20vh;'>
                    <div class='col-lg-12'>
                        <textarea class='w-100 h-100' readonly>$commentContent</textarea>
                    </div>
                </div>
            ";
        }
    }
    
@endphp
<script type="text/javascript">
    $(document).ready(function(){

    });
</script>
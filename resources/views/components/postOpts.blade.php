<div class="row mt-2">
    <div class="col-4 d-flex justify-content-center border">
        <form action="{{url('ajaxupload')}}" method="post" id="addLikeForm">
            <input type="hidden" name="ID" value="{{$userID}}">
            <input type="hidden" name="postID" value="{{$postID}}">
            <button type="submit" id="btnHeart" class="{{$heartStyle}}" id="heart"></button>
        </form>
    </div>
    <div class="col-4 d-flex justify-content-center">
        <a href="/post/{{$postID}}">
            <span class="post-item bi bi-chat-dots"></span>
        </a>
    </div>
    <div class="col-4 d-flex justify-content-center">
        <span class="post-item bi bi-share"></span>
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
                success: (resp) => {
                    
                },
                error: (xhr, status, error) => {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<div class="row">
        <div class="col-lg-4 col-md-3 col-sm-2 text-center border">
            <form action="{{url('ajaxupload')}}" method="post" id="addLikeForm">
                <input type="hidden" name="ID" value="{{$userID}}">
                <input type="hidden" name="postID" value="{{$postID}}">
                <button type="submit" id="btnHeart" class="{{$heartStyle}}" id="heart"></button>
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
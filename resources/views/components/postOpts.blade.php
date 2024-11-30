<div class="row mt-2">
    <div class="col-4 d-flex justify-content-center border-bottom">
        <form action="{{url('ajaxupload')}}" method="post" class="addLikeForm">
            <input type="hidden" name="ID" value="{{$userID}}">
            <input type="hidden" name="postID" value="{{$postID}}">
            <button class="btnHeart {{$heartStyle}}"></button>
        </form>
    </div>
    <div class="col-4 d-flex justify-content-center border-bottom">
        <a href="/post/{{$postID}}">
            <span class="post-item bi bi-chat-dots text-black"></span>
        </a>
    </div>
    <div class="col-4 d-flex justify-content-center border-bottom">
        <span class="post-item bi bi-share"></span>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(() => {
        $('.addLikeForm').on('submit', (event) => {
            event.preventDefault();
            event.stopImmediatePropagation();
            const heart = $(event.target).find('.btnHeart');
            var data = $(event.target).closest('form').serialize();
            $.ajax({
                url: "{{url('ajaxupload')}}",
                data: data,
                type: 'POST',
                success: (resp) => {
                    if(heart.hasClass('bi-heart'))
                    {
                        heart.removeClass('bi-heart').addClass('bi-heart-fill');
                    }
                    else
                    {
                        heart.removeClass('bi-heart-fill').addClass('bi-heart');
                    }
                },
                error: (xhr, status, error) => {
                    console.error(xhr.responseText);
                }
            });
            return false;
        });
    });
</script>
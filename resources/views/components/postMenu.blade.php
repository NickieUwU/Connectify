<table class="table table-hover invisible" id="menu">
    <tr>
        <td class="table table-danger">
            @php
                if($posterUsername == $_SESSION['username']) echo "<form action='/ajaxDeletePostUser' method='post' id='postMenuForm'>
                                                                        <input type='hidden' name='postID' value='$postID'>
                                                                        <button type='submit' class='bi bi-trash3-fill w-100 bg-transparent'>
                                                                            Delete
                                                                        </button>
                                                                </form>";
            else echo "
                            <span class='bi bi-flag-fill table table-danger'>
                               <a href='".url('report/'.$postID)."'>Report</a>
                            </span>
            ";
            @endphp
        </td>
    </tr>
</table>

<script type="text/javascript">
    $(document).ready(() => {
        $("#postMenuForm").on('submit', (e) => {
            e.preventDefault();
            $.ajax({
                url: "/ajaxDeletePostUser",
                type: "POST",
                data: $("#postMenuForm").serialize(),
                success: (resp) => {
                    location.reload();
                },
                error: (xhr, status, error) => {
                        console.error(xhr.responseText);
                }
            });
        });
    });
</script>
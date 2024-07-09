@php
    use App\Http\Controllers\DbHandlerController;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Reports</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <x-app username="{{$username}}">
        <div class="container-fluid">
            <table class="table table-hover text-center">
                <thead>
                    <td>Username</td>
                    <td>Link</td>
                    <td>Report Option</td>
                    <td>Action 1</td>
                    <td>Action 2</td>
                </thead>
                @php
                    $reports = DbHandlerController::queryAll('SELECT * FROM Reports');
                    foreach($reports as $report)
                    {
                        $ReportOption = $report['ReportOption'];
                        $repID = $report['ID'];
                        $repPostID = $report['Post_ID'];
                        $action2 = "";
                        if($repPostID != 0)
                        {
                            $action2 = "<form action='/ajaxDeletePost' id='deletePost' method='POST'>
                                            <input type='hidden' name='repPostID' value='$repPostID'>
                                            <input type='submit' class='btn btn-danger' value='delete post'>
                                        </form>";
                        }
                        $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE ID=?', $repID);
                        foreach($users as $user)
                        {
                            $repUsername = $user['Username'];
                            $link = url('/profile/'.$repUsername);
                            if($repPostID != 0) $link = url('/post/'.$repPostID);
                            echo "<tr>
                                    <td>$repUsername</td>
                                    <td>$link</td>
                                    <td>$ReportOption</td>
                                    <td>
                                        <form action='/ajaxSuspend' id='Suspend' method='POST'>
                                            <input type='hidden' name='reportID' value='$repID'>
                                            <input type='submit' class='btn btn-danger' value='suspend account'>
                                        </form>
                                    </td>
                                    <td>
                                        $action2
                                    </td>
                                </tr>";
                        }
                    } 
                @endphp
            </table>
        </div>
    </x-app>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#Suspend').on('submit', (e) => {
                e.preventDefault();
                $.ajax({
                    url: '/ajaxSuspend',
                    type: 'POST',
                    data: $('#Suspend').serialize(),
                    success: (resp) => {
                        location.reload();
                    },
                    error: (xhr, status, error) => {
                        console.error(xhr.responseText);
                    }
                })
            });
            $('#deletePost').on('submit', (e) => {
                e.preventDefault();
                $.ajax({
                    url: '/ajaxDeletePost',
                    type: 'POST',
                    data: $('#deletePost').serialize(),
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
</body>
</html>
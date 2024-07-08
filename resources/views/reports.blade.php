@php
    use App\Http\Controllers\DbHandlerController;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Reports</title>
</head>
<body>
    <x-app username="{{$username}}">
        <div class="container-fluid">
            <table class="table table-hover">
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
                        $users = DbHandlerController::queryAll('SELECT * FROM Users WHERE ID=?', $repID);
                        foreach($users as $user)
                        {
                            $repUsername = $user['Username'];
                            $link = "";
                            if($repPostID != 0) $link = url('/post/'.$repPostID);
                            echo "<tr>
                                    <td>$repUsername</td>
                                    <td>$link</td>
                                    <td>$ReportOption</td>
                                    <td>
                                        <form action='/reports' method='POST'>
                                            <input type='hidden' name='reportID' value='$repID'>
                                            <input type='submit' class='btn btn-danger' value='suspend account'>
                                        </form>
                                    </td>
                                    <td>
                                        <form action='/reports' method='POST'>
                                            <input type='hidden' name='repPostID' value='$repPostID'>
                                            <input type='submit' class='btn btn-danger' value='delete post'>
                                        </form>
                                    </td>
                                </tr>";
                        }
                    } 
                @endphp
            </table>
        </div>
    </x-app>
</body>
</html>
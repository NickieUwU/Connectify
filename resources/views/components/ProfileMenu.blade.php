<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/profileMenu.css')}}">
</head>
<body>
    <table class="table table-secondary table-hover w-25 text-center">
        <tbody>
            <tr>
                <td>
                    <a href="/report/{{$username}}">
                        <i class="bi bi-flag-fill"></i>Report User
                    </a>
                </td>
                
            </tr>
            <tr>
                <td><i class="bi bi-slash-circle"></i>Block</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
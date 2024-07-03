<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Signin</title>
</head>
<body>
    <x-logoutapp>
        <form action="/signin" method="POST">
            @if(isset($error))
                <label class="error">
                    {{ $error }}
                </label><br>
            @endif
            <label class="txtlogin">Signin</label><br>
            <input type="text" name="name" placeholder="Name" autocomplete="off"><br>
            <input type="text" name="username" placeholder="username" autocomplete="off" maxlength="30"><br>
            <input type="password" name="password" placeholder="password" autocomplete="off" maxlength="50"><br>
            <input type="submit" name="btnsubmit" class="btn btn-outline-secondary" value="Signin">
        </form>
    </x-logoutapp>
</body>
</html>

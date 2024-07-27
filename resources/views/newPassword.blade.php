<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / New Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-12 text-center fs-2">
                New password
            </div>
        </div>
        <form action="/" method="post">
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                        <input type="password" name="newPassword" placeholder="New Password"><br>
                        <input type="password" name="confirmNewPassword" placeholder="Confirm">
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-secondary">Reset</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
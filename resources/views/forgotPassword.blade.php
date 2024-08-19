<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Password Reset (provide email)</title>
    <style>
        body
        {
            overflow: hidden;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="row mt-3">
        <div class="col-12 text-center fs-2">
            Password reset
        </div>
    </div>
    <form action="/password-reset-email" method="post">
        <div class="row mt-5">
            <div class="col-12 d-flex justify-content-center">
                <input type="text" name="email" placeholder="your-email@example.com">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-12 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Send reset link</button>
            </div>
        </div>
    </form>
</body>
</html>
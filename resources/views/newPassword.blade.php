<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / New Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-12 text-center fs-2">
                New password
            </div>
        </div>
        <form action="/ajax-passwordReset" method="post"id="formNewPassword">
            <div class="row mt-5">
                <div class="col-12 d-flex justify-content-center">
                        <input type="password" name="newPassword" placeholder="New Password"><br>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-12 d-flex justify-content-center">
                    <input type="password" name="confirmNewPassword" placeholder="Confirm">
                </div>
                
            </div>
            <div class="row mt-2">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn btn-outline-secondary">Reset</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        $(document).ready(() => {
            $('#formNewPassword').on('submit', (event) => {
                event.preventDefault();
                $.ajax({
                    url: "/ajax-passwordReset",
                    type: "POST",
                    data: $('#formNewPassword').serialize(),
                    success: (resp) => {
                        
                    }
                });
            });
        });
    </script>
</body>
</html>
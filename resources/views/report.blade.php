@php
    $redirect = "";
    if($postID==0) $redirect = "$username";
    else $redirect = "$postID";
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectify / Report</title>
</head>
<body>
    <x-app username="{{$logusername}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1 class="mt-5">
                        @if($postID == 0)
                            Report {{$username}}
                        @else
                            Report {{$username}}'s post
                        @endif
                    </h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12 text-center">
                    <form action="{{$redirect}}" method="post">
                        <select name="ReportOptions">
                            @if($postID == 0)
                                <option value="Bullying">Bullying</option>
                                <option value="Copyright issues">Copyright issues</option>
                                <option value="Promotes Terrorism">Promotes Terrorism</option>
                            @else
                                <option value="Misleading content">Misleading content</option>
                                <option value="Copyright issues">Copyright issues</option>
                                <option value="Spam">Spam</option>
                            @endif
                        </select><br><br>
                        <button type="submit" class="btn btn-secondary">
                            Report
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
    </x-app>
</body>
</html>
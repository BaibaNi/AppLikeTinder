<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable-no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notification</title>
</head>

<body>
    <div class="container text-center">
        <div class="card border-1">
            <div class="card-title">
                <h1 style="color: crimson; font-family: Tahoma; text-align: center">Hey, {{ $user->name }}! You have a match! ❤</h1>
                <div class="card-body">
                    <p style="text-align: center">Check your TINDER APP account to know who is your match!</p>
                    <h1 style="color: crimson; font-family: Tahoma; text-align: center">❤</h1>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

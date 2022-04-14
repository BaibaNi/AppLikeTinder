<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TinderApp</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link href="/css/app.css" rel="stylesheet">
</head>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a href="/" class="navbar-brand">
            <img src="/images/img_1.png" width="50" height="50" class="d-inline-block align-bottom" alt="">
            TINDER APP
        </a>

        <ul class="navbar-nav">
            @auth
                <li class="nav-item">
                    <a href="/users/{{ auth()->user()->id }}" class="nav-link">Welcome, {{ auth()->user()->name }}! </a>
                </li>
                <li class="nav-item">
                    <form method="post" action="/logout" class="form-inline my-2 my-lg-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger my-2 my-sm-0">LOG OUT</button>
                    </form>
                </li>
            @else
                <li class="nav-item">
                    <a href="/login" class="nav-link">LOG IN</a>
                </li>
                <li class="nav-item">
                    <a href="/register" class="nav-link">REGISTER</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>


<body>
    <section>{{ $slot }}</section>

    <x-flash/>
</body>


<footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</footer>

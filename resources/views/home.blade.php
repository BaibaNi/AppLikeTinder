<x-layout>

@auth
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <ul class="navbar-brand navbar-nav">
                <div class="container-fluid text-start">
                    <form method="post" action="/users/{{ auth()->user()->id }}/clear-preferences">
                        @csrf

                        <button class="btn btn-outline-danger" disabled style="color: crimson; font-weight: bold; border: none">MY PREFERENCES:</button>

                        @if(auth()->user()->userPreference)

                            <button class="btn btn-sm btn-outline-danger" disabled>
                                Age range: {{ auth()->user()->userPreference->min_age }} - {{ auth()->user()->userPreference->max_age }}
                            </button>
                            <button class="btn btn-sm btn-outline-danger" disabled>
                                Gender: {{ auth()->user()->userPreference->gender }}
                            </button>
                            <button class="btn btn-sm btn-outline-danger" disabled>
                                Country: {{ auth()->user()->userPreference->location }}
                            </button>
                            <button class="btn btn-sm btn-outline-danger" type="button"
                                    onclick="location.href='/users/{{ auth()->user()->id }}/preferences'">
                                Change my preferences
                            </button>
                            <button class="btn btn-sm btn-outline-danger" type="submit">
                                Clear my preferences
                            </button>

                        @else
                            <button class="btn btn-sm btn-outline-danger" type="button"
                                    onclick="location.href='/users/{{ auth()->user()->id }}/preferences'">
                                Change my preferences
                            </button>
                        @endif
                    </form>

                </div>
            </ul>


            <ul class="navbar-nav">
                <button class="btn btn-sm btn-outline-danger m-1" type="button"
                        onclick="location.href='/users/{{ auth()->user()->id }}/matches'">
                    My matches ❤
                </button>
                <button class="btn btn-sm btn-outline-danger m-1" type="button"
                        onclick="location.href='/users/{{ auth()->user()->id }}'">
                    My profile
                </button>
            </ul>
        </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-5 g-4">
                @foreach( $users as $user)
                    @if(auth()->user()->id !== $user->id)
                        <div class="col">
                            <div class="card h-85">
                                <img src="/storage/{{ $user->userPicture->small_picture }}" class="card-img-top rounded mx-auto d-block"
                                     alt="{{ $user->username }}">

                                <div class="card-footer">
                                    <button class="btn btn-sm btn-outline-light" onclick="location.href='/users/{{ $user->id }}'">
                                        <h5 style="color: crimson">{{ $user->username }} ({{ $user->age }})</h5>
                                    </button>
                                    <form method="post">
                                        @csrf
                                        <button formmethod="post" class="btn btn-sm btn-outline-success" value="Yes"
                                                formaction="/users/{{ $user->id }}/like">Yes</button>
                                        <button formmethod="post" class="btn btn-sm btn-outline-danger" value="No"
                                                formaction="/users/{{ $user->id }}/dislike">No</button>
                                    </form>
                                </div>
                            </div>
                            <br>
                        </div>
                    @endif
                @endforeach
                <br>
            </div>
        </div>
    </div>

@else

    <div class="container-fluid">
        <div class="card-body text-center">
            <br><br><br><br><br><br>
            <h1>WELCOME TO TINDER APP</h1>
            <img src="/images/img_1.png" width="50" height="50" class="d-inline-block align-bottom" alt="">
            <br><br><br><br>
            <div class="row">
                <div class="col-6 text-end">
                    <button class="btn btn-sm btn-outline-danger" onclick="location.href='/login'">
                        LOG IN
                    </button>
                </div>
                <div class="col-6 text-start">
                    <button class="btn btn-sm btn-outline-danger" onclick="location.href='/register'">
                        REGISTER
                    </button>
                </div>
            </div>

        </div>
    </div>

@endauth

</x-layout>


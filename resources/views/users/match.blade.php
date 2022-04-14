<x-layout>

    @auth
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid justify-content-end">
                <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users'">
                    Find your match
                </button>
                <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users/{{ auth()->user()->id }}'">
                    My profile
                </button>
                <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users/{{ auth()->user()->id }}/edit'">
                    Edit my profile
                </button>
            </div>
        </nav>

        <div class="container-fluid text-center">
            <div class="card-body">
                @if( !$users )
                    <p>Hey, <b style="color: crimson">{{ auth()->user()->name }}</b>, you don't have any matches yet!</p>
                    <p>But don't worry - they are looking for you!</p>
                    <p>❤</p>
                @else
                <div class="row row-cols-1 row-cols-md-5 g-4">
                    @foreach( $users as $user)
                        @if(auth()->user()->id !== $user->id)
                            <div class="col">
                                <div class="card h-85">
                                    <img src="/storage/{{ $user->userPicture->small_picture }}" class="card-img-top rounded mx-auto d-block" alt="{{ $user->username }}">

                                    <div class="card-footer">
                                        <button class="btn btn-sm btn-outline-light" onclick="location.href='/users/{{ $user->id }}'">
                                            <h5 style="color: crimson">{{ $user->username }} ({{ $user->age }})</h5>
                                            @foreach($matches as $match)
                                                @if($match->user_id === $user->id && $match->match_id === auth()->user()->id)
                                                    <p class="small_date">❤ {{ $match->updated_at->diffForHumans() }}</p>
                                                @elseif($match->user_id === auth()->user()->id && $match->match_id === $user->id)
                                                    <p class="small_date">❤ {{ $match->updated_at->diffForHumans() }}</p>
                                                @endif
                                            @endforeach
                                        </button>
                                    </div>
                                </div>
                                <br>
                            </div>
                        @endif
                    @endforeach
                    <br>
                </div>
                @endif
            </div>
        </div>

    @endauth

</x-layout>


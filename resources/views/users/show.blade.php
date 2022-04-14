<x-layout>

    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid justify-content-end">
            <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users'">
                Find your match
            </button>
            <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users/{{ auth()->user()->id }}/matches'">
                My matches ❤
            </button>
            @if(auth()->user()->id === $user->id)
                <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users/{{ auth()->user()->id }}/edit'">
                    Edit my profile
                </button>
            @else
                <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users/{{ auth()->user()->id }}'">
                    My profile
                </button>
            @endif
        </div>
    </nav>

    <div class="container-fluid">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card" style="width: 18rem;">
                        <img src="/storage/{{ $user->userPicture->small_picture }}" class="card-img-top rounded mx-auto d-block"
                             alt="{{ $user->username }}" onclick="location.href='/storage/{{ $user->userPicture->picture }}'">
                        <div class="card-body">
                            <h5 class="card-title" style="color: crimson">PROFILE</h5>
                            <p class="card-text">
                                <b>Name:</b> {{ $user->name }}<br>
                                <b>Surname:</b> {{ $user->surname }}<br>
                                <b>Username:</b> {{ $user->username }}<br>
                                <b>Country:</b> {{ $user->location }}<br>
                                <b>Age:</b> {{ $user->age }}<br>
                                <b>Gender:</b> {{ $user->gender }}<br>
                            </p>
                        </div>


                        @if(auth()->user()->id !== $user->id && empty($matches))
                            <div class="card-footer">
                                <form method="post">
                                    @csrf
                                    <button formmethod="post" class="btn btn-sm btn-outline-success" value="Yes"
                                            formaction="/users/{{ $user->id }}/like">Yes</button>
                                    <button formmethod="post" class="btn btn-sm btn-outline-danger" value="No"
                                            formaction="/users/{{ $user->id }}/dislike">No</button>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="col-sm-9">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8 text-start">
                                <h5 class="card-title" style="color: crimson">ABOUT ME</h5>
                            </div>
                            @if(auth()->user()->id === $user->id)
                                <div class="col-sm-4 text-end">
                                    <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users/{{ auth()->user()->id }}/description'">
                                        Edit description
                                    </button>
                                </div>
                            @endif
                        </div>

                        @if(!empty($user->userDescription))
                        <div class="row">
                            <div class="container-fluid">
                                <div class="card-body">
                                    {{ $user->userDescription->description }}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>

                    <br>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-8 text-start">
                                <h5 class="card-title" style="color: crimson">GALLERY</h5>
                            </div>
                            @if(auth()->user()->id === $user->id)
                                <div class="col-sm-4 text-end">
                                    <button class="btn btn-sm btn-outline-danger m-1" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                        Upload images
                                    </button>

                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                                        <div class="offcanvas-header">
                                            <h5 id="offcanvasRightLabel" style="color: crimson">Upload images to your profile</h5>
                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body">
                                            <form method="post" action="/users/{{ $user->id }}/upload-images" enctype="multipart/form-data">
                                                @csrf

                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control"  id="image" name="image[]" aria-label="image" multiple>
                                                </div>

                                                <div>
                                                    <button type="submit" class="btn btn-danger">SAVE IMAGES</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-md-3 g-2">
                                @foreach( $images as $image)
                                    <div class="col">
                                        <div class="card w-100">
                                            <img src="/storage/{{ $image->small_image }}" class="rounded" alt="{{ $user->username }}"
                                                 id="image" onclick="location.href='/storage/{{ $image->image }}'">

                                            @if(auth()->user()->id === $user->id)
                                                <div class="card-footer text-end">
                                                    <form method="post" action="/users/{{ $user->id }}/delete-image/{{ $image->id }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                                value="delete">Delete</button>
                                                    </form>
                                                </div>
                                            @endif

                                        </div>
                                        <br>
                                    </div>
                                @endforeach
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>

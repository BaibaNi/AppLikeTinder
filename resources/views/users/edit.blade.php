<x-layout>


    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid justify-content-end">
            <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users'">
                Find your match
            </button>
            <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users/{{ $user->id }}/matches'">
                My matches ❤
            </button>
            <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users/{{ $user->id }}'">
                My profile
            </button>
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row g-0">

            <div class="col-md-4 text-center">
                <div class="card-body">
                    <img src="/storage/{{ $user->userPicture->small_picture }}" class="img-fluid rounded mx-auto d-block" alt="{{ $user->username }}">
                </div>

                <div>
                    <button class="btn btn-sm btn-outline-danger" type="button" onclick="location.href='/users/{{ $user->id }}/upload-picture'">
                        Change profile picture
                    </button>
                </div>
            </div>

            <div class="col-md-5 text-center">
                <div class="card-body">
                    <div class="row">
                        <form method="post" action="/users/{{ $user->id }}/edit" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="input-group mb-3">
                                <span class="input-group-text" aria-label="name">Name</span>
                                <input type="text" class="form-control"  id="name" name="name" aria-label="name"
                                       value="{{ $user->name }}" required >
                            </div>
                            @error('name')
                            <p class="small_error">{{ $message }}</p>
                            @enderror

                            <div class="input-group mb-3">
                                <span class="input-group-text" aria-label="surname">Surname</span>
                                <input type="text" class="form-control"  id="surname" name="surname" aria-label="surname"
                                       value="{{ $user->surname }}" required >
                            </div>
                            @error('surname')
                            <p class="small_error">{{ $message }}</p>
                            @enderror

                            <div class="input-group mb-3">
                                <span class="input-group-text" aria-label="username">Username</span>
                                <input type="text" class="form-control"  id="username" name="username" aria-label="username"
                                       value="{{ $user->username }}" required >
                            </div>
                            @error('username')
                            <p class="small_error">{{ $message }}</p>
                            @enderror

                            <div class="input-group mb-3">
                                <span class="input-group-text" aria-label="birthday">Birthday</span>
                                <input type="date" class="form-control"  id="birthday" name="birthday" aria-label="birthday"
                                       value="{{ $user->birthday }}" required >
                            </div>
                            @error('birthday')
                            <p class="small_error">{{ $message }}</p>
                            @enderror

                            <div class="input-group mb-3">
                                <span class="input-group-text" aria-label="location">Country</span>
                                <select name="location" class="form-control" id="location" name="location" aria-label="location">
                                    <option value="{{ $user->location }}" selected>{{ $user->location }}</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country }}" >{{ $country }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('location')
                            <p class="small_error">{{ $message }}</p>
                            @enderror

                            <div class="input-group mb-3">
                                <input type="text" class="form-control" aria-label="gender_f" value="Gender" disabled>

                                <div class="input-group-text">
                                    <input class="form-check-input form-check-inline mt-0" type="radio"
                                           value="Female" name="gender" aria-label="gender_f">
                                </div>
                                <input type="text" class="form-control" aria-label="gender_f" value="Female" disabled>

                                <div class="input-group-text">
                                    <input class="form-check-input form-check-inline mt-0" type="radio"
                                           value="Male" name="gender" aria-label="gender_m">
                                </div>
                                <input type="text" class="form-control" aria-label="gender_m" value="Male" disabled>
                            </div>
                            @error('gender')
                            <p class="small_error">{{ $message }}</p>
                            @enderror
                            <br>
                            <div>
                                <button type="submit" class="btn btn-danger">SUBMIT CHANGES</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3 text-end">
                <div class="card-body">
                    <div class="col">
                        @if($user->userPreference)
                        <div class="card-body">
                            <h5 class="card-title" style="color: crimson">MY PREFERENCES</h5>
                            <p class="card-text">
                                <b>Age range:</b> {{ $user->userPreference->min_age }} - {{ $user->userPreference->max_age }}<br>
                                <b>Gender:</b> {{ $user->userPreference->gender }}<br>
                                <b>Country:</b> {{ $user->userPreference->location }}<br>
                            </p>
                        </div>
                        @endif

                        <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users/{{ $user->id }}/preferences'">
                            Change my preferences
                        </button>
                        <br>
                        <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users/{{ $user->id }}/change-password'">
                            Change my password
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout>

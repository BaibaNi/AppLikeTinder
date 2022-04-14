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
            <button class="btn btn-sm btn-outline-danger m-1" type="button" onclick="location.href='/users/{{ $user->id }}/edit'">
                Edit my profile
            </button>
        </div>
    </nav>


    <div class="text-center">
        <div class="container-fluid">
            <div class="card-body">
                <div class="col w-50">
                    <form method="post" action="/users/{{ $user->id }}/change-password">
                        @csrf

                        <div class="input-group mb-3">
                            <span class="input-group-text" aria-label="password">New password</span>
                            <input type="password" class="form-control"  id="password" name="password" aria-label="password"
                                   value="{{ $user->password }}" required>
                        </div>
                        @error('password')
                        <p class="small_error">{{ $message }}</p>
                        @enderror

                        <div class="input-group mb-3">
                            <span class="input-group-text" aria-label="password_confirmation">Password confirmation</span>
                            <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" aria-label="password">
                        </div>

                        <div>
                            <button type="submit" class="btn btn-danger">CHANGE PASSWORD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>

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
                    <form method="post" action="/users/{{ $user->id }}/upload-picture" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group mb-3">
                            <span class="input-group-text" aria-label="picture">Change your profile picture</span>
                            <input type="file" class="form-control"  id="picture" name="picture" aria-label="picture"
                                   value="/storage/{{ $user->picture }}" required>
                        </div>
                        @error('picture')
                        <p class="small_error">{{ $message }}</p>
                        @enderror

                        <div>
                            <button type="submit" class="btn btn-danger">SAVE PICTURE</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>

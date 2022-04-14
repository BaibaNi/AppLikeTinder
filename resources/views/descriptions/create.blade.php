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
                <div class="col">
                    <form method="post" action="/users/{{ $user->id }}/description">
                        @csrf
                        <div class="form-floating">

                            @if(empty($user->userDescription))
                                <textarea class="form-control" id="description" name="description"></textarea>
                                <label for="description">Add a description about yourself</label>
                            @else
                                <textarea class="form-control" id="description" name="description">
                                    {{ trim($user->userDescription->description) }}
                                </textarea>
                                <label for="description">Add a description about yourself</label>
                            @endif
                        </div>
                        <br>
                        <div>
                            <button type="submit" class="btn btn-danger">SAVE DESCRIPTION</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>

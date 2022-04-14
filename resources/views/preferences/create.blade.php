<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

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
        <div class="container-fluid text-center">
            <div class="card-body">
                <div class="col w-50">
                    <form method="post" action="/users/{{ $user->id }}/preferences">
                        @csrf

                        <div class="input-group mb-3">
                            <input type="hidden" id="min_age">
                            <input type="hidden" id="max_age">
                            <span class="input-group-text" aria-label="age">Select age range:</span>
                            <input type="text" class="form-control" id="age" readonly aria-label="age" name="age"
                                   style="color:crimson; font-weight:bold">
                        </div>
                        <div id="slider-range"></div>
                        <br>

                        <div class="input-group mb-3">
                            <span class="input-group-text" aria-label="location">Country</span>
                            <select name="location" class="form-control"  id="location" name="location" aria-label="location">
                                <option value="" selected disabled>Select country</option>
                            @foreach($locations as $location)
                                    <option value="{{ $location }}">{{ $location }}</option>
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

                            <div class="input-group-text">
                                <input class="form-check-input form-check-inline mt-0" type="radio"
                                       value="Both" name="gender" aria-label="gender_b">
                            </div>
                            <input type="text" class="form-control" aria-label="gender_b" value="Both" disabled>
                        </div>
                        @error('gender')
                        <p class="small_error">{{ $message }}</p>
                        @enderror
                        <br>
                        <div>
                            <button type="submit" class="btn btn-danger">SUBMIT PREFERENCES</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-layout>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>

    $( function() {
        $("#slider-range").slider({
            range: true,
            min: 18,
            max: 81,
            values: [ 25, 35 ],
            slide: function( event, ui ) {
                $("#age").val(ui.values[ 0 ] + " - " + ui.values[ 1 ] );
            }
        });
        $("#age").val($("#slider-range").slider( "values", 0 ) +
            " - " + $("#slider-range").slider( "values", 1 ) );
        $("#min_age").val(ui.values[ 0 ]);
        $("#max_age").val(ui.values[ 1 ]);

    } );
</script>

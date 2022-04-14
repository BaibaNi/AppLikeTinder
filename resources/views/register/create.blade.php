
<x-layout>
    <div class="container">
        <div class="row">
            <div class="col" style="height: 50%">
            <h1>REGISTER</h1>

                <form method="post" action="/register" enctype="multipart/form-data">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="name">Name</span>
                        <input type="text" class="form-control"  id="name" name="name" aria-label="name"
                               value="{{ old('name') }}" required >
                    </div>
                    @error('name')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="surname">Surname</span>
                        <input type="text" class="form-control"  id="surname" name="surname" aria-label="surname"
                               value="{{ old('surname') }}" required >
                    </div>
                    @error('surname')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="username">Username</span>
                        <input type="text" class="form-control"  id="username" name="username" aria-label="username"
                               value="{{ old('username') }}" required >
                    </div>
                    @error('username')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="birthday">Birthday</span>
                        <input type="date" class="form-control"  id="birthday" name="birthday" aria-label="birthday"
                               value="{{ old('birthday') }}" required >
                    </div>
                    @error('birthday')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="location">Country</span>
                        <select name="location" class="form-control" id="location" name="location" aria-label="location">
                            <option value="{{ old('location') }}" selected>{{ old('location') }}</option>
                            @foreach($countries as $country)
                                <option value="{{ $country }}">{{ $country }}</option>
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


                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="email">Email</span>
                        <input type="email" class="form-control"  id="email" name="email" aria-label="email"
                               value="{{ old('email')  }}" required >
                    </div>
                    @error('email')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="password">Password</span>
                        <input type="password" class="form-control"  id="password" name="password" aria-label="password" required>
                    </div>
                    @error('password')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="password_confirmation">Password confirmation</span>
                        <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" aria-label="password">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="picture">Profile picture</span>
                        <input type="file" class="form-control"  id="picture" name="picture" aria-label="picture" required>
                    </div>
                    @error('picture')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div>
                        <button type="submit" class="btn btn-danger">REGISTER</button>
                    </div>
                    <br>

                </form>
            </div>
        </div>
    </div>
</x-layout>

<x-layout>
    <div class="container">
        <div class="row">
            <div class="col" style="height: 50%">

                <h1>LOGIN</h1>

                <form method="post" action="/login">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="email">Email</span>
                        <input type="text" class="form-control"  id="email" name="email" aria-label="email"
                               value="{{ old('email') }}" required >
                    </div>
                    @error('email')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="password">Password</span>
                        <input type="password" class="form-control"  id="password" name="password" aria-label="password" required >
                    </div>
                    @error('password')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div>
                        <button type="submit" class="btn btn-danger">LOG-IN</button>
                    </div>

                    <div>
                        <a href="/forgot-password">Forgot password?</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-layout>

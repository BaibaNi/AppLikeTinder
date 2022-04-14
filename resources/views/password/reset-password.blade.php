<x-layout>
    <div class="container">
        <div class="row">
            <div class="col" style="height: 50%">

                <h1>FORGOT PASSWORD</h1>

                @if (session('status'))
                    <div class="mb-4 text-sm-center">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="post" action="/reset-password">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="email">Email</span>
                        <input type="text" class="form-control"  id="email" name="email" aria-label="email"
                               value="{{ old('email'), $request->email }}" autofocus>
                    </div>
                    @error('email')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="password">Password</span>
                        <input type="password" class="form-control"  id="password" name="password" aria-label="password">
                    </div>
                    @error('password')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="password_confirmation">Password confirmation</span>
                        <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" aria-label="password">
                    </div>

                    <div>
                        <button type="submit" class="btn btn-danger">RESET PASSWORD</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-layout>

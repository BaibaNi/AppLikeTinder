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

                <form method="post" action="/forgot-password">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text" aria-label="email">Email</span>
                        <input type="text" class="form-control"  id="email" name="email" aria-label="email"
                               value="{{ old('email') }}" autofocus>
                    </div>
                    @error('email')
                    <p class="small_error">{{ $message }}</p>
                    @enderror

                    <div>
                        <button type="submit" class="btn btn-danger">Email password reset link</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-layout>

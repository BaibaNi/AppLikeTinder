@if (session()->has('success'))
    <div class="container-fluid">
        <div x-data="{ show: true }"
             x-init="setTimeout(() => show = false, 4000)"
             x-show="show"
             class="btn m-2 fixed-bottom" style="background-color: lightcoral; color: white">
            <p>{{ session('success') }}</p>
        </div>
    </div>
@endif

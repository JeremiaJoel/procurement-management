@if (Session::has('Success'))
    <div class="bg-green-200 border-green-600 p-4 mb-3 rounded-sm shadow-sm">
        {{ Session::get('Success') }}
    </div>
@endif
@if (Session::has('error'))
    <div class="bg-green-200 border-green-600 p-4 mb-3 rounded-sm shadow-sm">
        {{ Session::get('error') }}
    </div>
@endif

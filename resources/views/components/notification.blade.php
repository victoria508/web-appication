@if(Session::has('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-3">
        <p>{{ Session::get('success') }}</p>
    </div>
@endif

@if(Session::has('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-3">
        <p>{{ Session::get('error') }}</p>
    </div>
@endif

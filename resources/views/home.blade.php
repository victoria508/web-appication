@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <div class="flex flex-wrap justify-center">
        <div class="md:w-2/3 pr-4 pl-4">
            <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-grey-light">
                <h1 class="py-3 px-6 mb-0 text-4xl font-bold">Dashboard</h1>

                <div class="flex-auto p-6">
                    @if (session('status'))
                        <div class="relative px-3 py-3 mb-4 border rounded text-green-darker border-green-dark bg-green-lighter" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" href="{{ route('collections.index') }}">{{__('Manage collections')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

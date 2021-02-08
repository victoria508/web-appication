@extends('layouts.app')

@section('content')

    <div class="mx-auto md:w-1/2">

        @include('components.notification')

        <div class="mb-3 clearfix">
            <h1 class="font-bold text-4xl float-left">{{__('Collections')}}</h1>
            <a href="{{ route('collections.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold mt-3 ml-3 py-1 px-4 rounded focus:outline-none focus:shadow-outline float-left"
            >{{__('New collection')}}</a>
        </div>

        <form method="POST">
            @csrf
            <div class="flex flex-wrap">
                @if($collections->isEmpty())
                    <div>{{__('No collections')}}</div>
                @endif

                @foreach($collections as $collection)
                    <div class="w-1/3 mb-3">
                        <div class="border-2 rounded mr-3">
                            <a class="inline-block text-2xl text-blue-700 font-bold mx-3 my-2"
                               href="{{ route('collections.show',compact('collection')) }}"
                            >{{ $collection->name }}</a>
                            <div class="m-3 mt-0">
                                <p class="text-gray-700">{{__('created')}} {{ $collection->created_at->diffForHumans() }}</p>
                                <p class="text-gray-700">{{__('updated')}} {{ $collection->updated_at->diffForHumans() }}</p>
                            </div>
                            <div class="bg-gray-100 border-t px-3 py-2">
                                <a class="text-blue-600"
                                   href="{{ route('collections.edit', compact('collection')) }}"
                                >{{__('Edit')}}</a>
                                <button class="text-red-700 ml-1"}
                                        formaction="{{ route('collections.destroy', compact('collection')) }}"
                                        name="_method"
                                        value="delete"
                                >{{__('Delete')}}
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>

    </div>

@endsection

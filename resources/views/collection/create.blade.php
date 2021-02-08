@extends('layouts.app')

@section('content')

    <div class="mx-auto md:w-1/2">
        <h1 class="font-bold text-4xl mb-2">{{__('New collections')}}</h1>

        @include('components.notification')

        <form action="{{ route('collections.store') }}" method="POST">
            @csrf
            @method('post')

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="collection-form-name"
                    >
                        {{__('Name')}}
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="collection-form-name"
                           type="text"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="{{__('Name')}}"
                    >
                    @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit"
                    >
                        {{__('Create')}}
                    </button>
                    <a class="bg-gray-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                       href="{{ route('collections.index') }}"
                    >
                        {{__('Cancel')}}
                    </a>
                </div>
            </div>
        </form>
    </div>

@endsection

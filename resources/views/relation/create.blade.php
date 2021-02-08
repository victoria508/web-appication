@extends('layouts.app')

@section('content')

    <div class="mx-auto md:w-1/2">

        @include('components.notification')

        <form method="POST" action="{{ route('profiles.relations.create', compact('profile')) }}">
            @csrf
            @method('post')

            <h1 class="text-2xl text-gray-700 mb-2">
                {{__('Create relation on')}} <span class="text-4xl text-black font-bold">{{ $profile->name }}</span>
            </h1>

            <div class="flex flex-wrap -mx-3 mb-3">
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
                           placeholder="Name"
                    >
                    @error('name')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-3">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="collection-form-name"
                    >
                        {{__('profile')}}
                    </label>
                    <select class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="collection-form-profile"
                            name="related"
                    >
                        @foreach($profiles as $profile)
                        <option value="{{ $profile->id }}">{{ $profile->name }}</option>
                        @endforeach
                    </select>

                    @error('related')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit"
                    >
                        {{__('Save')}}
                    </button>
                </div>
            </div>

        </form>
    </div>

@endsection

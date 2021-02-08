@extends('layouts.app')

@section('content')

    <div class="mx-auto md:w-1/2">

        @include('components.notification')

        <form method="POST" action="{{ route('profiles.store', compact('profile')) }}">
            @csrf
            @method('post')

            <p class="text-gray-500 m-1">
                {{__('Collection')}}: {{ $profile->collection->name }}
            </p>

            <input class="appearance-none bg-transparent border-b border-b-2 border-blue-500 w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none font-bold text-4xl mb-2"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   placeholder="Name"
            >

            @error('name')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror

            <div class="flex flex-wrap -mx-3 mb-3">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                           for="collection-form-relation-name"
                    >
                        {{__('Relation Name')}}
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           id="collection-form-relation-name"
                           type="text"
                           name="relation"
                           value="{{ old('relation') }}"
                           placeholder="Name"
                    >
                    @error('relation')
                    <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex mb-3">
                <div class="w-full">
                    <div class="rounded border-2 w-full">
                        <div class="m-3">

                                <listform v-bind:list="{{ str_replace('"', '\'', json_encode(old('data') ?: [[]])) }}">
                                    <template #default="slotProps">
                                        <div class="flex flex-wrap -mx-3 mb-3">
                                            <div class="w-full px-3">

                                                <div class="flex">
                                                    <div class="w-4/12 mr-3">
                                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                               type="text"
                                                               :name="`data[${slotProps.index}][key]`"
                                                               :value="slotProps.item.key"
                                                               placeholder="Key"
                                                        >
                                                    </div>
                                                    <div class="w-8/12 mr-3">
                                                        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4  leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                                               type="text"
                                                               :name="`data[${slotProps.index}][value]`"
                                                               :value="slotProps.item.value"
                                                               placeholder="Value"
                                                        >
                                                    </div>
                                                    {{--                                                <div class="w-1/12">--}}
                                                    {{--                                                    <button class="appearance-none block w-full bg-red-600 text-white border rounded py-3 px-4 leading-tight hover:bg-red-700 font-bold"--}}
                                                    {{--                                                            type="button"--}}
                                                    {{--                                                            @click="$emit('remove')"--}}
                                                    {{--                                                    >--}}
                                                    {{--                                                        X--}}
                                                    {{--                                                    </button>--}}
                                                    {{--                                                </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                    </template>

                                    <template #remove>
                                        <button class="bg-red-500 hover:bg-red-700 text-white font-bold w-full mb-3 py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                type="button"
                                        >
                                            {{__('Remove')}}
                                        </button>
                                    </template>

                                    <template #add>
                                        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold w-full py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                                type="button"
                                        >
                                            {{__('Add')}}
                                        </button>
                                    </template>
                                </listform>


                        </div>
                    </div>
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

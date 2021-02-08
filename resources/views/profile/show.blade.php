@extends('layouts.app')

@section('content')

    <div class="mx-auto md:w-1/2">

        @include('components.notification')

        <form method="POST" action="{{ route('profiles.update', compact('profile')) }}">
            @csrf
            @method('put')

            <p class="text-gray-500 m-1">
                {{__('Collection')}}: {{ $profile->collection->name }},
                {{__('created')}}: {{ $profile->created_at->diffForHumans() }},
                {{__('updated')}}: {{ $profile->updated_at->diffForHumans() }}
            </p>

            <input class="appearance-none bg-transparent border-b border-b-2 border-blue-500 w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none font-bold text-4xl mb-2"
                   type="text"
                   name="name"
                   value="{{ $profile->name }}"
                   placeholder="Name"
            >

            @error('name')
            <p class="text-red-500 text-xs italic">{{ $message }}</p>
            @enderror

            <div class="flex mb-3">
                <div class="{{ 'w-2/3' }} mr-3">
                    <div class="rounded border-2 w-full">
                        <div class="m-3">

                            <listform v-bind:list="{{ str_replace('"', '\'', json_encode($profile->data)) }}">
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

                <!-- TODO: add errors -->
                <div class="w-1/3">
                    <div class="rounded border-2 w-full p-3">
                        <h2 class="text-2xl font-bold mb-1 -mt-1">{{__('Relations')}}</h2>
                        <ul class="">
                            @foreach($profile->relations as $relation)
                                @php
                                    /** @var TYPE_NAME $relation */
/** @var TYPE_NAME $profile */
$other = $relation->other($profile)->first();
                                @endphp
                                <li class="mb-1">
                                    <a href="{{ route('profiles.show', ['profile' => $other]) }}">
                                        {{ $other->name }}
                                    </a>
                                    @if(!empty($relation->name))
                                        ({{ $relation->name }})
                                    @endif

                                    (<a href="{{ route('profiles.relations.edit', compact('profile', 'relation')) }}">Edit</a>)
                                    (<button formaction="{{ route('profiles.relations.destroy', compact('profile', 'relation')) }}"
                                             name="_method"
                                             value="delete"
                                        class="text-red-700"
                                    >{{__('Delete')}}</button>)

                                </li>
                            @endforeach
                            <li>
                                <a class="bg-blue-500 hover:bg-blue-700 text-white text-center w-full block mt-3 py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                   href="{{ route('profiles.relations.create', compact('profile')) }}"
                                >{{__('Create new relation')}}</a>
                            </li>
                        </ul>
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

                    <a class="bg-gray-500 hover:bg-gray-700 text-white font-bold inline-block py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                       href="{{ route('profiles.create', compact('profile')) }}"
                    >
    {{__('Create profile')}}
</a>
</div>
</div>

</form>
</div>

@endsection

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Thambi+2:wght@500" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-body">
<div id="app">
    <nav class="w-full z-30 top-0 text-white gradient">

        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">

            <div class="pl-4 flex items-center">
                <a class="text-white font-brand font-bold no-underline hover:no-underline text-3xl lg:text-4xl toggleColour"
                   href="{{ route('welcome') }}"
                >
                    Brainr
                </a>
            </div>

            <div class="block lg:hidden pr-4">
                <button id="nav-toggle" class="flex items-center p-1 text-orange-800 hover:text-gray-900">
                    <svg class="fill-current h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                    </svg>
                </button>
            </div>

            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block mt-2 lg:mt-0 bg-white lg:bg-transparent text-black p-4 lg:p-0 z-20"
                 id="nav-content"
            >
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    @guest
                        <li class="nav-item">
                            <a href="{{ route(Route::currentRouteName(), ['lang'=>'en']) }}" class = "inline-block text-white no-underline hover:text-gray-800 hover:text-underline py-2 px-4">EN</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route(Route::currentRouteName(), ['lang'=>'nl']) }}" class = "inline-block text-white no-underline hover:text-gray-800 hover:text-underline py-2 px-4">NL</a>
                        </li>
                        <li class="mr-3">
                            <a class="inline-block text-white no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                               href="{{ route('login') }}"
                            >{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="mr-3">
                                <a class="inline-block text-white no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                                   href="{{ route('register') }}"
                                >{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="mr-3 relative">
                            <dropdown>
                                <template #toggle>
                                    <a class="inline-block text-white no-underline hover:text-gray-800 hover:text-underline py-2 px-4">
                                        {{ Auth::user()->name }}
                                    </a>
                                </template>

                                <div class="absolute top-auto right-0 bg-white border-b-2 rounded shadow"
                                     style="min-width: 150px;"
                                >
                                    <ul class="">
                                        <li class="mr-3">
                                            <a class="inline-block no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                                               href="{{ route('home') }}"
                                            >
                                                Dashboard
                                            </a>
                                        </li>
                                        <li class="mr-3">
                                            <a class="inline-block no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                                               href="{{ route('logout') }}"
                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            >
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form"
                                                  action="{{ route('logout') }}"
                                                  method="POST"
                                                  style="display: none;"
                                            >
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </dropdown>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>

        <hr class="border-b border-gray-100 opacity-25 my-0 py-0"/>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>

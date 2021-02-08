<template>
    <nav class="w-full z-30 top-0 text-white gradient">

        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">

            <div class="pl-4 flex items-center">
                <router-link :to="{name: 'home'}"
                             class="text-white font-brand font-bold no-underline hover:no-underline text-3xl lg:text-4xl toggleColour"
                >
                    Brainr
                </router-link>
            </div>

            <div class="block lg:hidden pr-4">
                <button id="nav-toggle" class="flex items-center p-1 text-white hover:text-gray-900">
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
                    <guest>
                        <li class="mr-3">
                            <router-link :to="{name: 'login'}"
                                         class="inline-block text-white no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                            >Sign in
                            </router-link>
                        </li>
                    </guest>
                    <guest>
                        <li class="mr-3">
                            <router-link :to="{name: 'register'}"
                                         class="inline-block text-white no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                            >Sign up
                            </router-link>
                        </li>
                    </guest>

                    <auth v-slot:default="{user}">

                        <li class="mr-3 relative">
                            <dropdown>
                                <template #toggle>
                                    <a class="inline-block text-white no-underline hover:text-gray-800 hover:text-underline py-2 px-4">
                                        {{ user.name }}
                                    </a>
                                </template>

                                <div class="absolute top-auto right-0 bg-white border-b-2 rounded shadow"
                                     style="min-width: 150px;"
                                >
                                    <ul class="">
                                        <li class="mr-3">
                                            <router-link class="inline-block no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                                                         :to="{name:'dashboard'}"
                                            >
                                                Dashboard
                                            </router-link>
                                        </li>
                                        <li class="mr-3">
                                            <a class="inline-block no-underline hover:text-gray-800 hover:text-underline py-2 px-4"
                                               href="#"
                                               @click="logout"
                                            >
                                                Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </dropdown>
                        </li>

                    </auth>
                </ul>
            </div>
        </div>

        <hr class="border-b border-gray-100 opacity-25 my-0 py-0"/>
    </nav>
</template>

<script>
    import dropdown from '../../components/BaseDropDown';

    export default {
        components: {
            dropdown,
        },
        methods   : {
            logout()
            {
                this.$store.dispatch('auth/logout').then(() => this.$router.push({name: 'home'}));
            },
        },
    };
</script>

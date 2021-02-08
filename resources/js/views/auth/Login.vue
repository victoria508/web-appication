<template>
    <div class="mx-auto w-1/2 md:1/4 lg:w-1/5 mt-12">
        <div class="border shadow-md rounded px-5 py-6 mb-6">
            <form @submit.prevent="login" @keydown="form.errors.clear($event.target.name)">
                <div class="mb-5">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">E-mail
                        Address</label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           :class="{ 'border-red-500': form.errors.has('email') }"
                           type="text"
                           name="email"
                           id="email"
                           placeholder="E-mail Address"
                           autofocus
                           v-model="form.data.email"
                    >
                    <span class="text-red-500 text-xs italic" v-if="form.errors.has('email')"
                          v-text="form.errors.get('email')"
                    ></span>
                </div>

                <div class="mb-5">
                    <div class="flex justify-between">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                               for="password"
                        >Password</label>
                        <a class="inline-block align-baseline font-light text-sm text-blue-600 hover:text-blue-500"
                           href="#"
                        >
                            Forgot Password?
                        </a>
                    </div>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        :class="{ 'border-red-500': form.errors.has('password') }"
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Password"
                        v-model="form.data.password"
                    >
                    <span class="text-red-100 text-xs italic" v-if="form.errors.has('password')"
                          v-text="form.errors.get('password')"
                    ></span>
                </div>

                <!--                <div class="mb-5">-->
                <!--                    <input class="mr-2 leading-tight" type="checkbox" name="remember" id="remember">-->
                <!--                    <label class="text-sm text-gray-700" for="remember">Rebember me</label>-->
                <!--                </div>-->

                <button
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-light uppercase py-3 px-6 rounded focus:outline-none focus:shadow-outline"
                    type="submit"
                >Sign In
                </button>
            </form>
        </div>

        <div class="border shadow-md rounded p-4">
            <p class="text-center text-md font-light">Don't have an account?
                <router-link class="font-light text-md text-blue-600" :to="{ name: 'register' }">Create
                    one
                </router-link>
            </p>
        </div>

        <p class="text-center text-gray-400 text-sm pt-3">&copy; 2020 Brainr. All rights reserved.</p>
    </div>
</template>

<script>
    import Form from '../../utils/forms';
    import brainr from '../../apis/brainr';

    export default {
        data: () => ({
            form: new Form({
                email: '',
                password: '',
            }, brainr),
        }),
        methods: {
            login()
            {
                this.form.submitThrough(data => this.$store.dispatch('auth/login', data)).then(() =>
                    this.$router.push({name: 'dashboard'}));
            },
        },
    };
</script>
